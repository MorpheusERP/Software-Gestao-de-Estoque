<?php

//Este arquivo serve para atualizar os dados do local de destino, com base na requisição do arquivo alterarLocal.html

include '../conexao.php';// Conexão com o banco de dados

// Recebe os dados JSON do corpo da requisição
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id_Local'])) {
    // Prepara a consulta de atualização
    $stmt = $mysqli->prepare("UPDATE local_destino SET tipo_Local = ?, nome_Local = ?, observcao = ? WHERE id_Local = ?");

    // Vincula os parâmetros
    $stmt->bind_param("sssi", $data['tipo_Local'], $data['nome_Local'], $data['observacao'], $data['id_Local']);

    // Executa a consulta
    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Local atualizado com sucesso."]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar Local: " . $stmt->error]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Dados incompletos."]);
}

$stmt->close();
$mysqli->close();
?>
