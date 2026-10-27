<?php

ob_start();
include('../config.php');
include(DBAPI);

$users = null;
$user = null;

/**
 * Listagem de Usuários
 */
function index()
{
    global $users;

    $database = open_database();

    $search = trim($_GET['search'] ?? '');

    if ($search !== '') {
        $sql = "SELECT * FROM usuarios
                WHERE nome LIKE ?
                ORDER BY id DESC";

        $stmt = $database->prepare($sql);
        $termo = '%' . $search . '%';
        $stmt->bind_param("s", $termo);
        $stmt->execute();

        $result = $stmt->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
    } else {
        $users = find_all('usuarios');
    }

    close_database($database);
}

/**
 * Visualização de um Usuário
 */
function view($id = null)
{
    global $user;

    $user = find('usuarios', $id);
}

/**
 * Cadastro de Usuários
 */
function add()
{
    if (!empty($_POST['user'])) {

        $user = $_POST['user'];

        // Campos permitidos pela tabela usuarios.
        $dados = [
            'nome' => trim($user['nome'] ?? ''),
            'user' => trim($user['user'] ?? ''),
            'password' => $user['password'] ?? '',
            'foto' => null
        ];

        // Validação dos campos obrigatórios.
        if (
            $dados['nome'] === '' ||
            $dados['user'] === '' ||
            $dados['password'] === ''
        ) {
            die('Preencha todos os campos obrigatórios.');
        }

        // Cria o hash da senha antes de salvar.
        $dados['password'] = password_hash(
            $dados['password'],
            PASSWORD_DEFAULT
        );

        // Foto opcional.
        if (
            isset($_FILES['img']) &&
            $_FILES['img']['error'] !== UPLOAD_ERR_NO_FILE
        ) {
            if ($_FILES['img']['error'] !== UPLOAD_ERR_OK) {
                die('Erro ao enviar a foto.');
            }

            if ($_FILES['img']['size'] > 5 * 1024 * 1024) {
                die('A foto deve ter no máximo 5 MB.');
            }

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($_FILES['img']['tmp_name']);

            $tiposPermitidos = [
                'image/jpeg' => 'jpg',
                'image/png'  => 'png',
                'image/webp' => 'webp'
            ];

            if (!isset($tiposPermitidos[$mime])) {
                die('Envie uma imagem JPG, PNG ou WEBP.');
            }

            $pasta = __DIR__ . '/../uploads/usuarios/';

            if (!is_dir($pasta)) {
                mkdir($pasta, 0755, true);
            }

            $nomeArquivo = bin2hex(random_bytes(16))
                . '.' . $tiposPermitidos[$mime];

            if (!move_uploaded_file(
                $_FILES['img']['tmp_name'],
                $pasta . $nomeArquivo
            )) {
                die('Não foi possível salvar a foto.');
            }

            $dados['foto'] = 'uploads/usuarios/' . $nomeArquivo;
        }

        save('usuarios', $dados);

        header('location: index.php');
        exit;
    }
}

/**
 * Atualização/Edição de Usuário
 */
function edit()
{
    global $user;

    if (!isset($_GET['id'])) {
        header('location: index.php');
        exit;
    }

    $id = (int) $_GET['id'];
    $userAtual = find('usuarios', $id);

    if (!$userAtual) {
        header('location: index.php');
        exit;
    }

    $user = $userAtual;

    if (!isset($_POST['user'])) {
        return;
    }

    $form = $_POST['user'];

    $dados = [
        'nome' => trim($form['nome'] ?? ''),
        'user' => trim($form['user'] ?? ''),
        'foto' => $userAtual['foto']
    ];

    if ($dados['nome'] === '' || $dados['user'] === '') {
        die('Preencha o nome e o nome de usuário.');
    }

    // Só altera a senha se uma nova senha for informada.
    if (!empty($form['password'])) {
        $dados['password'] = password_hash(
            $form['password'],
            PASSWORD_DEFAULT
        );
    }

    $fotoAntiga = $userAtual['foto'];
    $novaFoto = null;

    // Verifica se uma nova foto foi enviada.
    if (
        isset($_FILES['img']) &&
        $_FILES['img']['error'] !== UPLOAD_ERR_NO_FILE
    ) {
        if ($_FILES['img']['error'] !== UPLOAD_ERR_OK) {
            die('Erro ao enviar a nova foto.');
        }

        if ($_FILES['img']['size'] > 5 * 1024 * 1024) {
            die('A foto deve ter no máximo 5 MB.');
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($_FILES['img']['tmp_name']);

        $tiposPermitidos = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp'
        ];

        if (!isset($tiposPermitidos[$mime])) {
            die('Envie uma imagem JPG, PNG ou WEBP.');
        }

        $pasta = __DIR__ . '/../uploads/usuarios/';

        if (!is_dir($pasta)) {
            mkdir($pasta, 0755, true);
        }

        $nomeArquivo = bin2hex(random_bytes(16))
            . '.' . $tiposPermitidos[$mime];

        if (!move_uploaded_file(
            $_FILES['img']['tmp_name'],
            $pasta . $nomeArquivo
        )) {
            die('Não foi possível salvar a nova foto.');
        }

        $novaFoto = 'uploads/usuarios/' . $nomeArquivo;
        $dados['foto'] = $novaFoto;
    }

    // Atualiza somente os campos existentes na tabela.
    update('usuarios', $id, $dados);

    // Exclui a foto antiga se uma nova foi enviada.
    if ($novaFoto !== null && !empty($fotoAntiga)) {
        $caminhoAntigo = __DIR__ . '/../' . ltrim($fotoAntiga, '/');

        if (
            strpos($fotoAntiga, 'uploads/usuarios/') === 0 &&
            is_file($caminhoAntigo)
        ) {
            unlink($caminhoAntigo);
        }
    }

    header('location: index.php');
    exit;
}

/**
 * Exclusão de um Usuário
 */
function delete($id = null)
{
    global $user;

    $user = remove('usuarios', $id);

    header('location: index.php');
    exit;
}

function clear_messages() {
$_SESSION['message'] = null;
$_SESSION['type'] = null;
}
