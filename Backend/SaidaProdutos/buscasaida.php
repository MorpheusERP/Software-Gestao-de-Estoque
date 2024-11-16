<?php

include '../conexao.php';

// Recebe os dados enviados pelo JavaScript
$data = json_decode(file_get_contents('php://input'), true);
$id_Lote = $data['id_Lote'];

// Prepara a consulta SQL para buscar registros com o id_Lote informado
$sql = 'SELECT imagem, cod_Produto, nome_Produto, nome_Local, tipo_Local, qtd_Saida, observacao, id_Lote
        FROM saida_produtos
        WHERE id_Lote = ?';
    
$stmt = $mysqli->prepare($sql);

// Verifica se a preparação da consulta foi bem-sucedida
if (!$stmt) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro na consulta às saídas.']);
    exit();
}

// Vincula o parâmetro id_Lote e executa a consulta
$stmt->bind_param('i', $id_Lote);
$stmt->execute();
$result = $stmt->get_result();

// Armazena os resultados em um array para o retorno
$produtos = [];
while ($row = $result->fetch_assoc()) {
    $produtos[] = $row;
}

// Fecha a consulta
$stmt->close();
$mysqli->close();

// Retorna os resultados para o JavaScript em formato JSON
if (!empty($produtos)) {
    echo json_encode(['produtos' => $produtos]);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Nenhum produto encontrado.']);
}
?>
