<?php

//Este arquivo serve para inserir novos fornecedores com base nos dados informados pelo arquivo Cadastro.html

include '../conexao.php';

header('Content-Type: application/json'); // Define o cabeçalho para JSON

error_reporting(E_ALL); // Relatar todos os erros
ini_set('display_errors', 1); // Exibir erros

$data = json_decode(file_get_contents("php://input"), true);

$razao_Social = $data['razao_Social'];
$nome_Fantasia = $data['nome_Fantasia'] ?? null;
$apelido = $data['apelido'] ?? null;
$grupo = $data['grupo'];
$sub_Grupo = $data['sub_Grupo'] ?? null;
$observacao = $data['observacao'] ?? null;

// Verifica se o fornecedor já existe
$sqlCheck = "SELECT * FROM fornecedor WHERE razao_Social = ?";
$stmtCheck = $mysqli->prepare($sqlCheck);
$stmtCheck->bind_param("s", $razao_Social);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    echo json_encode(["status" => "erro", "mensagem" => "Erro: Fornecedor já cadastrado."]);
    $stmtCheck->close();
    $mysqli->close();
    exit();
}
$stmtCheck->close(); // Fecha o statement do SELECT para liberar a próxima operação

// Consulta SQL para inserir o usuário
    $sql = "INSERT INTO fornecedor (razao_Social, nome_Fantasia, apelido, grupo, sub_Grupo, observacao) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepara a declaração para evitar injeção de SQL
    $stmt = $mysqli->prepare($sql);

    if (!$stmt) {
        echo json_encode(["status" => "erro", "mensagem" => "Erro na preparação da consulta: ".$mysqli->error]);
    }

    // Associa os parâmetros e executa a declaração
    $stmt->bind_param("ssssss", $razao_Social, $nome_Fantasia, $apelido, $grupo, $sub_grupo, $observacao);
    $stmt->execute();
    echo json_encode(["status" => "sucesso", "mensagem" => "Fornecedor adicionado com sucesso!"]);

// Fecha a conexão com o banco de dados
$stmt->close();
$mysqli->close();
?>