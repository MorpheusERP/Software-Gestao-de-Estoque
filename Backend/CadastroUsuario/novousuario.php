<?php

//Este arquivo serve para inserir novos usuarios com base nos dados informados pelo arquivo Cadastro.html

include '../conexao.php';

header('Content-Type: application/json'); // Define o cabeçalho para JSON

error_reporting(E_ALL); // Relatar todos os erros
ini_set('display_errors', 1); // Exibir erros

$data = json_decode(file_get_contents("php://input"), true);

$nivel_Usuario = $data['nivel'];
$nome_Usuario = $data['nome'];
$sobrenome = $data['sobrenome'];
$funcao = $data['funcao'];
$login = $data['login'];
$senha = $data['senha'];

// Criptografa a senha usando password_hash
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Verifica se o usuário já existe
$sqlCheck = "SELECT * FROM usuario WHERE login = ?";
$stmtCheck = $mysqli->prepare($sqlCheck);
$stmtCheck->bind_param("s", $login);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    echo json_encode(["status" => "erro", "mensagem" => "Erro: Usuário já cadastrado."]);
    $stmtCheck->close();
    $mysqli->close();
    exit();
}
$stmtCheck->close(); // Fecha o statement do SELECT para liberar a próxima operação

// Consulta SQL para inserir o usuário
    $sql = "INSERT INTO usuario (nivel_Usuario, nome_Usuario, sobrenome, funcao, login, senha) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepara a declaração para evitar injeção de SQL
    $stmt = $mysqli->prepare($sql);

    if (!$stmt) {
        echo json_encode(["status" => "erro", "mensagem" => "Erro na preparação da consulta: ".$mysqli->error]);
    }

    // Associa os parâmetros e executa a declaração
    $stmt->bind_param("ssssss", $nivel_Usuario, $nome_Usuario, $sobrenome, $funcao, $login, $senhaHash);
    $stmt->execute();
    echo json_encode(["status" => "sucesso", "mensagem" => "Usuário adicionado com sucesso!".$stmt->error]);

// Fecha a conexão com o banco de dados
$stmt->close();
$mysqli->close();
?>