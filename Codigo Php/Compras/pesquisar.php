<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    
<?php
include('conexao.php');

$pesquisar = $_POST['pesquisar'];


$stmt = $conexao->prepare("SELECT fornecedor, produto, quantidade FROM compras WHERE produto LIKE ?");
$pesquisar = "%$pesquisar%";
$stmt->bind_param("s", $pesquisar);

$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo "<table class='table'><thead><tr><th>Fornecedor</th><th>Produto</th><th>Quantidade</th></tr></thead><tbody>";
    
    while ($row = $resultado->fetch_assoc()) {
        echo "<tr><td>".$row['fornecedor']."</td>
        <td>".$row['produto']."</td>
        <td>".$row['quantidade']."</td></tr>";
    }

    echo "</tbody></table>";
} else {
    echo "Zero Resultados";
}

$stmt->close();
$conexao->close();
?>
</body>
</html>