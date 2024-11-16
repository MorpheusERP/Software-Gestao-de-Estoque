<?php

//Este arquivo serve para consultas de Produto com cod_Produtos fornecido pelo arquivo alterarProduto.html

// Inclui o arquivo de conexão com o banco de dados
include '../conexao.php';

// Verifica se o COD do produto foi passado como parâmetro
if (isset($_GET['cod_Produto'])) {
    // Obtém o COD do Produto fornecido
    $cod_Produto = $_GET['cod_Produto'];

    // Prepara a consulta para retornar apenas o Produto com o cod fornecido
    $sql = "SELECT imagem, preco_Venda, nome_Produto, tipo_Produto, cod_Barras, preco_Custo, grupo, sub_Grupo, observacao FROM produto WHERE cod_Produto = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $cod_Produto); // 'i' indica que o parâmetro é um inteiro
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se encontrou o Produto
    if ($result->num_rows > 0) {
        // Retorna o Produto como JSON
        $produto = $result->fetch_assoc();
        echo json_encode($produto);
    } else {
        // Retorna mensagem de erro se o Produto não foi encontrado
        echo json_encode(["status" => "erro", "mensagem" => "Produto não encontrado"]);
    }

    // Libera a consulta e fecha a conexão
    $stmt->close();
    $mysqli->close();
} else {
    // Retorna mensagem de erro se o ID do Produto não foi fornecido
    echo json_encode(["status" => "erro", "mensagem" => "COD do Produto não fornecido"]);
}
?>
