<?php

//Este arquivo serve para atualizar os dados do Fornecedor, com base na requisição do arquivo alterarFornecedor.html

include '../conexao.php';// Conexão com o banco de dados

// Recebe os dados JSON do corpo da requisição
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id_Fornecedor'])) {
    // Prepara a consulta de atualização
    $stmt = $mysqli->prepare("UPDATE fornecedor SET razao_Social = ?, nome_Fantasia = ?, apelido = ?, grupo = ?, sub_Grupo = ?, observacao = ? WHERE id_Fornecedor = ?");

    // Vincula os parâmetros
    $stmt->bind_param("ssssssi", $data['razao_Social'], $data['nome_Fantasia'], $data['apelido'], $data['grupo'], $data['sub_Grupo'], $data['observacao'], $data['id_Fornecedor']);

    // Executa a consulta
    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Fornecedor atualizado com sucesso."]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar Fornecedor: " . $stmt->error]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Dados incompletos."]);
}

$stmt->close();
$mysqli->close();
?>
