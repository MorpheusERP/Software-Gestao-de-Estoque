<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo1.css">
</head>
<body>
<?php
    include('conexao.php');
     
    $razao = mysqli_real_escape_string($conexao, $_POST['NOVOrazao']);
    $fantasia = mysqli_real_escape_string($conexao, $_POST['NOVOfantasia']);
    $apelido = mysqli_real_escape_string($conexao, $_POST['NOVOapelido']);
    $grupo = mysqli_real_escape_string($conexao, $_POST['NOVOgrupo']);
   
    $stmt = $conexao->prepare("UPDATE fornecedor SET razao = ?, fantasia = ?, apelido = ?, grupo = ? WHERE razao = ?");
    $stmt->bind_param("sssss", $razao, $fantasia, $apelido, $grupo, $razao);

    if ($stmt->execute()) {
        echo "Dados atualizados no estoque.<br><br>";
    } else {
        echo "Erro na atualização do estoque: " . $stmt->error;
    }

    $stmt->close();
    $sql = "SELECT razao, fantasia, apelido, grupo FROM fornecedor";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><thead><tr><th>Razão Social</th><th>Nome Fantasia</th><th>Apelido</th><th>Grupo</th></tr></thead><tbody>";
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr><td>".$row['razao']."</td>
            <td>".$row['fantasia']."</td>
            <td>".$row['apelido']."</td>
            <td>".$row['grupo']."</td></tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
?>
</body>
</html>


