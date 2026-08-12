<?php

// mysqli_report(MYSQLI_REPORT_STRICT);
$mysqli_driver = new mysqli_driver();
$mysqli_driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

function open_database()
{
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $conn->set_charset("utf8");
        return $conn;
    } catch (Exception $e) {
        throw new Exception("Erro ao conectar ao banco de daos:<br> {$e->getMessage()}");
        
        //echo $e->getMessage();
        // return null;
    }
}

function close_database($conn)
{
    try {
        // $conn = null;
        $conn->close();
    } catch (Exception $e) {
        throw new Exception("Erro ao fechar ao banco de daos:<br> {$e->getMessage()}");
    }
}