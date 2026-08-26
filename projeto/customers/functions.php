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
  $customers = find_all('customers');
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
function formatarData($dado, $format = 'd/m/Y'): String
{
  $data = new DateTimeImmutable($dado);
  return $data->format($format);
}

/**
 *  Cadastro de Clientes
 */
function add()
{
  if (!empty($_POST['customer'])) {
    $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));

    $customer = $_POST['customer'];
    $customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");

    save('customers', $customer);
    header('location: index.php');
  }
}
