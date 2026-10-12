<?php 
  include "functions.php"; 

  if (isset($_GET['id'])){
    delete($_GET['id']);
  } else {
    $_SESSION['message'] = "ERRO: ID não definido!";
    $_SESSION['type'] = "danger";
    header("location:index.php");
    // die("ERRO: ID não definido.");
  }
?>