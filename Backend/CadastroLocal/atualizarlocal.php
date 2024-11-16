<?php

//Este arquivo serve para atualizar os dados do local de destino, com base na requisição do arquivo alterarLocal.html

include '../conexao.php';// Conexão com o banco de dados

// Recebe os dados JSON do corpo da requisição
$data = json_decode(file_get_contents('php://input'), true);

$id_Local = $data['id_Local'];
$tipo_Local = $data['tipo_Local'];
$nome_Local = $data['nome_Local'];
$observacao = $data['observacao'] ?? null;

if ($id_Local && $tipo_Local && $nome_Local) {
    try {
    // Prepara a consulta de atualização
    $sql = "UPDATE local_destino SET tipo_Local = ?, nome_Local = ?, observacao = ? WHERE id_Local = ?";
    $stmt = $mysqli->prepare($sql );
    $stmt->bind_param("sssi", $data['tipo_Local'], $data['nome_Local'], $data['observacao'], $data['id_Local']);
    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Local de destino atualizado com sucesso."]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar Local: " . $stmt->error]);
    }
} catch (mysqli_sql_exception $e) {
    // Verifica se a mensagem de erro contém 'foreign key constraint fails'
    if (str_contains($e->getMessage(), 'foreign key constraint fails')) {
        echo json_encode([
            "status" => "erro",
            "mensagem" => "Não é possível excluir, ou atualizar o local de destino porque há registros vinculados a ele."
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
