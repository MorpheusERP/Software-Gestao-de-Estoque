<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fornecedor = $_POST['fornecedor'];
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];

    $sql = "INSERT INTO compras (fornecedor, produto, quantidade) VALUES ('$fornecedor', '$produto', '$quantidade')";
    if (mysqli_query($conexao, $sql)) {
        echo "Dados salvos com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
    }

    mysqli_close($conexao);
}
?>



