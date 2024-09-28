<?php
    include ('conexao.php');
    $pasta = "delet";
 
    $deletar = $_POST['deletar'];

    $sql =  "DELETE FROM saida WHERE produto = '$deletar'";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado){
        echo "<h1> Produnto excluido com sucesso </h1>";
    }
    else {
        echo "<h1>Produnto não foi ecluido </h1>".mysqli_error($conexao);
    }
    mysqli_close($conexao);

?>