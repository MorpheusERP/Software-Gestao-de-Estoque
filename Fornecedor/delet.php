<?php
    include('conexao.php');

    $deletar = $_POST['deletar'];

    // Corrige a consulta SQL para deletar registros com base em um único campo
    $sql = "DELETE FROM fornecedor WHERE razao = '$deletar' OR fantasia = '$deletar' OR apelido = '$deletar' OR grupo = '$deletar'";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        echo "<h1>Produto excluído com sucesso</h1>";
    } else {
        echo "<h1>Produto não foi excluído</h1>" . mysqli_error($conexao);
    }

    mysqli_close($conexao);
?>
