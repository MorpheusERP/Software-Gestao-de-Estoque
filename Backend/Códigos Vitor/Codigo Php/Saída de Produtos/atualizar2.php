<!DOCTYPE html>
<html lang="en">
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
     
    $media = $_POST['NOVOmedia'];
    $produto = $_POST['NOVOproduto'];
    $locald = $_POST['NOVOlocald'];
    $quantidade = $_POST['NOVOquantidade'];

    // Atualiza os dados no banco de dados
    $stmt = $conexao->prepare("UPDATE saida SET produto = ?, locald = ?, quantidade = ? WHERE media = ?");
    $stmt->bind_param("sssi", $produto, $locald, $quantidade, $media);

    if ($stmt->execute()) {
        echo "Dados atualizados no estoque.<br><br>";
    } else {
        echo "Erro na atualização do estoque: " . $stmt->error;
    }

    $stmt->close();

    // Seleciona e exibe os dados atualizados
    $sql = "SELECT media, produto, locald, quantidade FROM saida";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><thead><tr><th>Media</th><th>Produto</th><th>Locald</th><th>Quantidade</th></tr></thead><tbody>";
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr><td>".$row['media']."</td>
            <td>".$row['produto']."</td>
            <td>".$row['locald']."</td>
            <td>".$row['quantidade']."</td></tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
?>
</body>
</html>
