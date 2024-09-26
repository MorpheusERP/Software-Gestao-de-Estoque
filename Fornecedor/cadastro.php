<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $razao = $_POST['razao'];
    $fantasia = $_POST['fantasia'];
    $apelido = $_POST['apelido'];
    $grupo = $_POST['grupo'];

    $sql = "INSERT INTO fornecedor (razao, fantasia, apelido, grupo) VALUES ('$razao', '$fantasia', '$apelido', '$grupo')";
    if (mysqli_query($conexao, $sql)) {
        echo "Dados salvos com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
    }

    mysqli_close($conexao);
}
?>