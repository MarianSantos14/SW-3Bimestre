<?php

ob_start();
include('../config.php');
include(DBAPI);

$users = null;
$user = null;



/**
 *  Visualização de um Cliente
 */
function view($id = null)
{
  global $user;
  $user = find('usuario', $id);
}


/**
 *  Listagem de Clientes
 */
function index()
{
    global $users;

    $database = open_database();

    $search = trim($_GET['search'] ?? '');

    if ($search !== '') {
        $sql = "SELECT * FROM users
                WHERE name LIKE ?
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
 *  Cadastro de Clientes
 */

function add()
{
  if (!empty($_POST['usuario'])) { // <<== nome do vetor html

    // $today = new DateTime('now', new DateTimeZone("-0300"));

    $user = $_POST['usuario'];
    // $customer['modified'] = $customer['created'] =
    //   $today->format("Y-m-d H:i:s");

    // Foto opcional
    $user['img'] = null;

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

      $pasta = __DIR__ . '/../uploads/users/';

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

      $user['img'] = 'uploads/users/' . $nomeArquivo;
    }

    save('usuarios', $user);
    header('location: index.php');
    exit;
  }
}


/**
 *	Atualizacao/Edicao de Cliente
 */
function edit()
{
    global $customer;

    if (!isset($_GET['id'])) {
        header('location: index.php');
        exit;
    }

    $id = (int) $_GET['id'];
    $userAtual = find('user', $id);

    if (!$userAtual) {
        header('location: index.php');
        exit;
    }

    $customer = $customerAtual;

    if (!isset($_POST['customer'])) {
        return;
    }

    $user = $_POST['customer'];
    $user['modified'] = date('Y-m-d H:i:s');

    // Mantém a foto atual caso nenhuma nova seja enviada.
    $user['img'] = $userAtual['img'];

    $fotoAntiga = $userAtual['img'];
    $novaFoto = null;

    // Verifica se foi enviada uma nova foto.
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

        $pasta = __DIR__ . '/../uploads/users/';

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

        $novaFoto = 'uploads/users/' . $nomeArquivo;
        $user['img'] = $novaFoto;
    }

    // Atualiza os dados e o caminho da foto no banco.
    update('usuarios', $id, $user);

    // Apaga a foto antiga somente quando uma nova foi enviada.
    if ($novaFoto !== null && !empty($fotoAntiga)) {
        $caminhoAntigo = __DIR__ . '/../' . ltrim($fotoAntiga, '/');

        if (
            strpos($fotoAntiga, 'uploads/users/') === 0 &&
            is_file($caminhoAntigo)
        ) {
            unlink($caminhoAntigo);
        }
    }

    header('location: index.php');
    exit;
}


/**
 *  Exclusão de um Cliente
 */
function delete($id = null) {

  global $user;
  $user = remove("users", $id);

  header("location: index.php");
}