<?php
    include ('conexao.php');
    $pasta = "delet";
 
    $deletar = $_POST['deletar'];

    $sql =  "DELETE FROM usuario WHERE nivel = '$deletar'";

    $resultado = mysqli_query($conexao, $sql);

    if ($resultado){
        echo "<h1> Usuario excluido </h1>";
    }
    else {
        echo "<h1>Usuario não foi ecluido </h1>".mysqli_error($conexao);
    }
    mysqli_close($conexao);

?>