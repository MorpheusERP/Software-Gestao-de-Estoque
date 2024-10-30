<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $razao_Social = $_POST['razao_Social'];
    $nome_Fornecedor = $_POST['nome_Fornecedor'];
    $apelido = $_POST['apelido'];
    $grupo = $_POST['grupo'];
    $observacao = $_POST['observacao'];

    // Insere os dados na tabela fornecedor
    $sql = "INSERT INTO fornecedor (razao_Social, nome_Fornecedor, apelido, grupo, observacao) 
            VALUES ('$razao_Social', '$nome_Fornecedor', '$apelido', '$grupo', '$observacao')";

    if (mysqli_query($conexao, $sql)) {
        echo "Dados salvos com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
    }

    // Fechando a conexão com o banco de dados
    mysqli_close($conexao);
}
?>
