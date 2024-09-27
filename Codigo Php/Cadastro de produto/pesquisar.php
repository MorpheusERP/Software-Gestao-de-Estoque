<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de dados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

<?php
    include('conexao.php');

    $pesquisar = $_POST['pesquisar'];

    
    $stmt = $conexao->prepare("SELECT * FROM cadastro WHERE produto LIKE ?");
    $pesquisar = "%$pesquisar%";
    $stmt->bind_param("s", $pesquisar);

    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "<table class='table'><th>ID</th><th>Produto</th><th>Quantidade</th><th>Valor de Compra</th><th>Valor de Venda</th><th>Validade</th><tr>";

        while ($row = $resultado->fetch_assoc()) {
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

    $stmt->close();
    mysqli_close($conexao);
?>
</body>
</html>