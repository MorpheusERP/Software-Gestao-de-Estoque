<?php

//Este arquivo serve para atualizar os dados do Fornecedor, com base na requisição do arquivo alterarFornecedor.html

include '../conexao.php';// Conexão com o banco de dados

// Recebe os dados JSON do corpo da requisição
$data = json_decode(file_get_contents('php://input'), true);

$id_Fornecedor = $data['id_Fornecedor'];
$razao_Social = $data['razao_Social'];
$nome_Fantasia = $data['nome_Fantasia'] ?? null;
$apelido = $data['apelido'] ?? null;
$grupo = $data['grupo'];
$sub_Grupo = $data['sub_Grupo'] ?? null;
$observacao = $data['observacao'] ?? null;

if ($id_Fornecedor && $razao_Social && $grupo) {
    try {
        // Prepara a consulta de atualização
        $sql = "UPDATE fornecedor SET razao_Social = ?, nome_Fantasia = ?, apelido = ?, grupo = ?, sub_Grupo = ?, observacao = ? WHERE id_Fornecedor = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            // Vincula os parâmetros
            $stmt->bind_param("ssssssi", $razao_Social, $nome_Fantasia, $apelido, $grupo, $sub_Grupo, $observacao, $id_Fornecedor);

            // Executa a consulta
            $stmt->execute();
            echo json_encode(["status" => "sucesso", "mensagem" => "Fornecedor atualizado com sucesso."]);

            $stmt->close();
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Erro na preparação da consulta."]);
        }
    } catch (mysqli_sql_exception $e) {
        // Verifica se a mensagem de erro contém 'foreign key constraint fails'
        if (str_contains($e->getMessage(), 'foreign key constraint fails')) {
            echo json_encode([
                "status" => "erro",
                "mensagem" => "Não é possível excluir, ou atualizar a razão social deste fornecedor porque há registros vinculados a ele."
            ]);
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar fornecedor: " . $e->getMessage()]);
        }
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Dados incompletos."]);
}

$mysqli->close();
?>
