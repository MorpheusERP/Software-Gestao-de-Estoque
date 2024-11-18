<?php

//Este arquivo serve para atualizar os campos de login e senha do usuário informado pelo arquivo novasenha.html

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include '../conexao.php';

header('Content-Type: application/json'); // Define o cabeçalho para JSON

error_reporting(E_ALL); // Relatar todos os erros
ini_set('display_errors', 1); // Exibir erros

$data = json_decode(file_get_contents("php://input"), true);
$login = $data['login'];
$novaSenha = $data['novaSenha'];

// Gera um hash para a nova senha
$senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

// Prepara a instrução SQL para atualizar a senha do usuário com o login informado
$sql = "UPDATE usuario SET senha = ? WHERE login = ?";
$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    echo json_encode(["status" => "erro", "mensagem" => "Erro na preparação da consulta: " . $mysqli->error]);
    exit();
}

// Vincula os parâmetros e executa a consulta
$stmt->bind_param("ss", $senhaHash, $login);
if ($stmt->execute()) {
    echo json_encode(["status" => "sucesso", "mensagem" => "Dados atualizados com sucesso!"]);
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar: " . $stmt->error]);
}

// Fecha a conexão
$stmt->close();
$mysqli->close();
?>