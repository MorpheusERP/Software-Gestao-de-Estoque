<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['ID'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];

    
    $check_sql = "SELECT * FROM grupo WHERE ID = '$ID'";
    $result = mysqli_query($conexao, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Erro: O ID já existe.";
    } else {
        
        $sql = "INSERT INTO grupo (ID, nome, tipo) VALUES ('$ID', '$nome', '$tipo')";
        
        if (mysqli_query($conexao, $sql)) {
            echo "Dados salvos com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
        }
    }

    mysqli_close($conexao);
}
?>
