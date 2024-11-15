<?php

//Este arquivo serve para inserir novos usuarios com base nos dados informados pelo arquivo Cadastro.html

include '../conexao.php';

header('Content-Type: application/json'); // Define o cabeçalho para JSON

error_reporting(E_ALL); // Relatar todos os erros
ini_set('display_errors', 1); // Exibir erros

$data = json_decode(file_get_contents("php://input"), true);

$tipo_Local = $data['tipo_Local'];
$nome_Local = $data['nome_Local'];
$observacao = $data['observacao'];

// Verifica se o local já existe
$sqlCheck = "SELECT * FROM local_destino WHERE nome_Local = ?";
$stmtCheck = $mysqli->prepare($sqlCheck);
$stmtCheck->bind_param("s", $nome_Local);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    echo json_encode(["status" => "erro", "mensagem" => "Erro: Local já cadastrado."]);
    $stmtCheck->close();
    $mysqli->close();
    exit();
}
$stmtCheck->close(); // Fecha o statement do SELECT para liberar a próxima operação

// Consulta SQL para inserir o usuário
    $sql = "INSERT INTO local_destino (tipo_Local, nome_Local, observacao) VALUES (?, ?, ?)";

    // Prepara a declaração para evitar injeção de SQL
    $stmt = $mysqli->prepare($sql);

    if (!$stmt) {
        echo json_encode(["status" => "erro", "mensagem" => "Erro na preparação da consulta: ".$mysqli->error]);
    }

    // Associa os parâmetros e executa a declaração
    $stmt->bind_param("sss", $tipo_Local, $nome_Local, $observacao);
    $stmt->execute();
    echo json_encode(["status" => "sucesso", "mensagem" => "Local adicionado com sucesso!".$stmt->error]);

// Fecha a conexão com o banco de dados
$stmt->close();
$mysqli->close();
?>