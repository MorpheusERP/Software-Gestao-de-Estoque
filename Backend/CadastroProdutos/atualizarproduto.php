<?php

//Este arquivo serve para atualizar os dados do Produto, com base na requisição do arquivo alterarProduto.html

include '../conexao.php';// Conexão com o banco de dados

// Recebe os dados JSON do corpo da requisição
$data = json_decode(file_get_contents('php://input'), true);

// Processamento da imagem
$imagem = $_FILES['imagem'];
$imagemNome = $imagem['name'];
$imagemTemp = $imagem['tmp_name'];
$imagemDestino = "imagens/" . uniqid() . '_' . $imagemNome;

if (isset($data['cod_Produto'])) {
    // Prepara a consulta de atualização
    $stmt = $mysqli->prepare("UPDATE produto SET imagem = ?, preco_Venda = ?, nome_Produto = ?, tipo_Produto = ?, cod_Barras = ?, preco_Custo = ?, grupo = ?, sub_Grupo = ?, observacao = ? WHERE cod_Produto = ?");

    // Vincula os parâmetros
    $stmt->bind_param("sdssidsssi", $imagemDestino, $data['preco_Venda'], $data['nome_Produto'], $data['tipo_Produto'], $data['cod_Barras'], $data['preco_Custo'], $data['grupo'], $data['subgrupo'], $data['observacao'], $data['cod_Produto']);

    // Executa a consulta
    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Produto atualizado com sucesso."]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar Produto: " . $stmt->error]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Dados incompletos."]);
}

$stmt->close();
$mysqli->close();
?>
