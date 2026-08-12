<?php
include "config.php";
include DBAPI;

try {

    $db = open_database();

    echo "<h1>Banco de Dados conectado!</h1>";
} catch (Exception $e) {
    echo "<h1>{$e->getMessage()}</h1>\n";
}

?>