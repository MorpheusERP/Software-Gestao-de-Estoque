<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
</head>
<body>
    

<?php
    include('conexao.php');
     
    $ID =  mysqli_real_escape_string($conexao, $_POST['NOVOID']);
    $nome = mysqli_real_escape_string($conexao, $_POST['NOVOnome']);
    $tipo = mysqli_real_escape_string($conexao, $_POST['NOVOtipo']);
   
    $stmt = $conexao->prepare("UPDATE grupo SET ID = ?, nome = ?, tipo = ? WHERE ID = ?");
    $stmt->bind_param("ssss", $ID, $nome, $tipo, $ID);

    if ($stmt->execute()) {
        echo "Dados atualizados no estoque.<br><br>";
    } else {
        echo "Erro na atualização do estoque: " . $stmt->error;
    }

    $stmt->close();

    $sql = "SELECT ID, nome, tipo FROM grupo";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><thead><tr><th>ID</th><th>Nome</th><th>Tipo de Local</th></tr></thead><tbody>";
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr><td>".$row['ID']."</td><td>".$row['nome']."</td><td>".$row['tipo']."</td></tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
?>
</body>
</html>

