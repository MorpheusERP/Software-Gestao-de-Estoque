<?php
include("conexao.php");

$media = $_POST['media'];
$produto = $_POST['produto'];
$locald = $_POST['locald']; 
$quantidade = $_POST['quantidade'];

$sql = "INSERT INTO saida (media, produto, locald, quantidade) VALUES ('$media', '$produto', '$locald', '$quantidade')";

if (mysqli_query($conexao, $sql)) {
    echo "Novo registro criado com sucesso";
} else {
    echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
}

mysqli_close($conexao);
?>

