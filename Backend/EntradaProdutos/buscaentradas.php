<?php

include '../conexao.php';

// Recebe os dados enviados pelo JavaScript
$data = json_decode(file_get_contents('php://input'), true);
$id_Lote = $data['id_Lote'];

//Prepara a consula SQL para buscar registros com o id_Lote informado
$sql ='SELECT id_Fornecedor, razao_Social, cod_Produto, nome_Produto, qtd_Entrada, preco_Custo, id_Lote
        FROM entrada_produtos
        WHERE id_Lote = ?';
    
$stmt = $mysqli->prepare($sql);

//verifica se a preparação da consulta foi bem sucedida
if (!$stmt){
    echo json_encode((['status' => 'erro', 'mensagem' => 'Erro na consulta as entradas.']));
    exit();
}

//vincula o parâmetro id_Lote e executa a consulta
$stmt->bind_param('i', $id_Lote);
$stmt->execute();
$result = $stmt->get_result();

//Armazena os resultados em um array para o retorno
$produtos = [];
while ($row = $result->fetch_assoc()) {
    $produtos[] = $row;
}

//Fecha a consulta
$stmt->close();
$mysqli->close();

//Retorna os resultados para o javascript em formato json
if(!empty($produtos)){
    echo json_encode(['produtos' => $produtos]);
}else{
    echo json_encode(['Erro na consulta']);
}