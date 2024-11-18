<?php
//Este arquivo realiza a conexão com o banco de dados, sendo referenciado em todos os outros arquivos PHP
    $host = "127.0.0.1";
    $user = "root";
    $password = "#$61@0Aljk";
    $database = "projeto_gestao";

// Cria uma nova conexão com o MySQL
$mysqli = new mysqli($host, $user, $password, $database);

// Verifica a conexão
if ($mysqli->connect_error) {
    die("Erro de conexão com o banco de dados: " . $mysqli->connect_error);
    
    if ($mysqli->connect_error) {
    echo json_encode(["status" => "erro", "mensagem" => "Erro ao conectar ao banco de dados."]);
    exit(); // Encerra o script
}

// Defina o charset para evitar problemas com caracteres especiais
$mysqli->set_charset("utf8");
?>