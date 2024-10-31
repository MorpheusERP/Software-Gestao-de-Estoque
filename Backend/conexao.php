<?php
    $host = "127.0.0.1";
    $user = "root";
    $password = "#$61@0Aljk";
    $database = "teste_autenticacao";

// Cria uma nova conexão com o MySQL
$mysqli = new mysqli($host, $user, $password, $database);

// Verifica a conexão
if ($mysqli->connect_error) {
    die("Erro de conexão com o banco de dados: " . $mysqli->connect_error);
}

// Defina o charset para evitar problemas com caracteres especiais
$mysqli->set_charset("utf8");
?>