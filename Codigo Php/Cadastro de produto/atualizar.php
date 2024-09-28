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
     
    $ID = $_POST['NOVOID'];
    $produto = $_POST['NOVOproduto'];
    $quantidade = $_POST['NOVOquantidade'];
    $valor_compra = $_POST['NOVOvalor_compra'];
    $valor_venda = $_POST['NOVOvalor_venda'];
    $validade = $_POST['NOVOvalidade'];


    $stmt = $conexao->prepare("UPDATE cadastro SET produto = ?, quantidade = ?, valor_compra = ?, valor_venda = ?, validade = ? WHERE ID = ?");
    $stmt->bind_param("siddsi", $produto, $quantidade, $valor_compra, $valor_venda, $validade, $ID);

    if ($stmt->execute()) {
        echo "Dados atualizados no estoque.<br><br>";
    } else {
        echo "Erro na atualização do estoque: " . $stmt->error;
    }

    $stmt->close();


    $sql = "SELECT ID, produto, quantidade, valor_compra, valor_venda, validade FROM cadastro";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><th>ID</th><th>Produto</th><th>Quantidade</th><th>Valor de Compra</th><th>Valor de Venda</th><th>Validade</th><tr>";
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr><td>".$row['ID']."</td>
            <td>".$row['produto']."</td>
            <td>".$row['quantidade']."</td>
            <td>".$row['valor_compra']."</td>
            <td>".$row['valor_venda']."</td>
            <td>".$row['validade']."</td></tr>";
        }

        echo "</table>";
    } else {
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
?>
</body>
</html>
