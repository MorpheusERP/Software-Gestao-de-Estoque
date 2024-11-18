<?php
include("conexao.php");

// Verifique se os dados foram enviados corretamente
if (isset($_POST['id_Estoque']) && isset($_POST['cod_Produto']) && isset($_POST['qtd_Estoque'])) {
    $id_Estoque = $_POST['id_Estoque'];
    $cod_Produto = $_POST['cod_Produto'];
    $qtd_Estoque = $_POST['qtd_Estoque'];

    // Verifica se o id_Estoque já existe no banco de dados
    $check_id_sql = "SELECT * FROM estoque WHERE id_Estoque = '$id_Estoque'";
    $result_id = mysqli_query($conexao, $check_id_sql);

    // Verifica se o cod_Produto já existe no banco de dados
    $check_cod_sql = "SELECT * FROM estoque WHERE cod_Produto = '$cod_Produto'";
    $result_cod = mysqli_query($conexao, $check_cod_sql);

    if (mysqli_num_rows($result_id) > 0) {
        echo "Erro: O ID de Entrada já existe. Por favor, insira um ID único.";
    } elseif (mysqli_num_rows($result_cod) > 0) {
        echo "Erro: O Código do Produto já está cadastrado. Por favor, insira um código único.";
    } else {
        // Inserção de novos dados com os campos id_Estoque, cod_Produto e qtd_Estoque
        $sql = "INSERT INTO estoque (id_Estoque, cod_Produto, qtd_Estoque) VALUES ('$id_Estoque', '$cod_Produto', '$qtd_Estoque')";
        
        if (mysqli_query($conexao, $sql)) {
            echo "Dados salvos com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . mysqli_error($conexao);
        }
    }
} else {
    echo "Erro: Todos os campos são obrigatórios!";
}

mysqli_close($conexao);
?>