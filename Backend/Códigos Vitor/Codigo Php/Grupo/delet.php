<?php
    include ('conexao.php');

    
    $deletar = mysqli_real_escape_string($conexao, $_POST['deletar']);

    $sql = "DELETE FROM grupo WHERE ID = '$deletar'";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado){
        echo "<h1>Produto excluído com sucesso</h1>";
    } else {
        echo "<h1>Produto não foi excluído</h1>" . mysqli_error($conexao);
    }

    mysqli_close($conexao);
?>

