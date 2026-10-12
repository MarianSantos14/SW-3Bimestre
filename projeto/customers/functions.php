<?php

ob_start();
include('../config.php');
include(DBAPI);

$customers = null;
$customer = null;

/**
 *  Listagem de Clientes
 */
function index()
{
    global $customers;

    $database = open_database();

    $search = trim($_GET['search'] ?? '');

    if ($search !== '') {
        $sql = "SELECT * FROM customers
                WHERE name LIKE ?
                ORDER BY id DESC";

        $stmt = $database->prepare($sql);
        $termo = '%' . $search . '%';
        $stmt->bind_param("s", $termo);
        $stmt->execute();

        $result = $stmt->get_result();
        $customers = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
    } else {
        $customers = find_all('customers');
    }

    close_database($database);
}

/**
 *  Visualização de um Cliente
 */
function view($id = null)
{
  global $customer;
  $customer = find('customers', $id);
}

/**
 * Formatar numero de telefone
 */
function formatPhone($phone)
{
  $phone = preg_replace('/\D/', '', $phone);

  if (strlen($phone) === 11) {
    return sprintf(
      '(%s) %s-%s',
      substr($phone, 0, 2),
      substr($phone, 2, 5),
      substr($phone, 7, 4)
    );
  }

  if (strlen($phone) === 10) {
    return sprintf(
      '(%s) %s-%s',
      substr($phone, 0, 2),
      substr($phone, 2, 4),
      substr($phone, 6, 4)
    );
  }

  return $phone;
}

/**
 * Formatar data
 * @param string $dado
 */
function formatarData($dado, $format = 'd/m/Y'): string
{
  $data = new DateTimeImmutable($dado);
  return $data->format($format);
}


/**
 * Formatar CEP
 */
function formatarCEP($cep)
{
    $cep = preg_replace('/\D/', '', $cep);

    if (strlen($cep) === 8) {
        return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $cep);
    }

    return $cep;
}

/**
 * Formatar CPF ou CNPJ
 */
function formatarCpfCnpj($documento)
{
    $documento = preg_replace('/\D/', '', $documento);

    if (strlen($documento) === 11) {
        return preg_replace(
            '/(\d{3})(\d{3})(\d{3})(\d{2})/',
            '$1.$2.$3-$4',
            $documento
        );
    }

    if (strlen($documento) === 14) {
        return preg_replace(
            '/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/',
            '$1.$2.$3/$4-$5',
            $documento
        );
    }

    return $documento;
}

/**
 *  Cadastro de Clientes
 */


function add()
{
  if (!empty($_POST['customer'])) {

    $today = new DateTime('now', new DateTimeZone("-0300"));

    $customer = $_POST['customer'];
    $customer['modified'] = $customer['created'] =
      $today->format("Y-m-d H:i:s");

    // Foto opcional
    $customer['img'] = null;

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

      $pasta = __DIR__ . '/../uploads/customers/';

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

      $customer['img'] = 'uploads/customers/' . $nomeArquivo;
    }

    save('customers', $customer);
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
    $customerAtual = find('customers', $id);

    if (!$customerAtual) {
        header('location: index.php');
        exit;
    }

    $customer = $customerAtual;

    if (!isset($_POST['customer'])) {
        return;
    }

    $customer = $_POST['customer'];
    $customer['modified'] = date('Y-m-d H:i:s');

    // Mantém a foto atual caso nenhuma nova seja enviada.
    $customer['img'] = $customerAtual['img'];

    $fotoAntiga = $customerAtual['img'];
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

        $pasta = __DIR__ . '/../uploads/customers/';

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

        $novaFoto = 'uploads/customers/' . $nomeArquivo;
        $customer['img'] = $novaFoto;
    }

    // Atualiza os dados e o caminho da foto no banco.
    update('customers', $id, $customer);

    // Apaga a foto antiga somente quando uma nova foi enviada.
    if ($novaFoto !== null && !empty($fotoAntiga)) {
        $caminhoAntigo = __DIR__ . '/../' . ltrim($fotoAntiga, '/');

        if (
            strpos($fotoAntiga, 'uploads/customers/') === 0 &&
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

  global $customer;
  $customer = remove("customers", $id);

  header("location: index.php");
}