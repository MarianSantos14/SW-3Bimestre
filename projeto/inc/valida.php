<?php
// inc/valida.php

require_once __DIR__ . "/../config.php";
require_once DBAPI;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o formulário foi enviado.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . BASEURL . "inc/login.php");
    exit;
}

// Recebe e valida os campos.
$usuario = trim($_POST['login'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($usuario === '' || $senha === '') {
    $_SESSION['message'] = "Preencha o usuário e a senha.";
    $_SESSION['type'] = "danger";

    header("Location: " . BASEURL . "inc/login.php");
    exit;
}

$bd = null;

try {
    $bd = open_database();

    // Busca o usuário com segurança.
    $sql = "SELECT id, nome, user, password
            FROM usuarios
            WHERE user = ?
            LIMIT 1";

    $stmt = $bd->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_assoc();

    $stmt->close();

    // Verifica se o usuário existe.
    if (!$dados) {
        throw new Exception("Usuário ou senha incorretos.");
    }

    $senhaBanco = $dados['password'];

    // Aceita hashes criados com password_hash().
    $senhaValida = password_verify($senha, $senhaBanco);

    // Compatibilidade temporária com senhas antigas em texto puro.
    $senhaAntiga = !$senhaValida
        && hash_equals($senhaBanco, $senha);

    if (!$senhaValida && !$senhaAntiga) {
        throw new Exception("Usuário ou senha incorretos.");
    }

    // Converte senhas antigas para hash após login válido.
    if ($senhaAntiga || password_needs_rehash(
        $senhaBanco,
        PASSWORD_DEFAULT
    )) {
        $novoHash = password_hash($senha, PASSWORD_DEFAULT);

        $update = $bd->prepare(
            "UPDATE usuarios SET password = ? WHERE id = ?"
        );

        $update->bind_param("si", $novoHash, $dados['id']);
        $update->execute();
        $update->close();
    }

    // Cria uma nova sessão após autenticar.
    session_regenerate_id(true);

    $_SESSION['id'] = $dados['id'];
    $_SESSION['nome'] = $dados['nome'];
    $_SESSION['user'] = $dados['user'];

    $_SESSION['message'] = "Bem-vindo, " . $dados['nome'] . "!";
    $_SESSION['type'] = "success";

    header("Location: " . BASEURL . "index.php");
    exit;

} catch (Throwable $e) {
    $_SESSION['message'] = $e instanceof mysqli_sql_exception
        ? "Não foi possível realizar o login. Verifique a conexão com o banco."
        : $e->getMessage();

    $_SESSION['type'] = "danger";

    header("Location: " . BASEURL . "inc/login.php");
    exit;

} finally {
    if ($bd instanceof mysqli) {
        $bd->close();
    }
}
