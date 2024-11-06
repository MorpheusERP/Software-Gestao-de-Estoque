<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "projetoalfa";

   
    $conexao = mysqli_connect($servidor, $usuario, $senha, $dbname);

    if (!$conexao) {
        die("Erro na senha: " . mysqli_connect_error());
    }
?>




