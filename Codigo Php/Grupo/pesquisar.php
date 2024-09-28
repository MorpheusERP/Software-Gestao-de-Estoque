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
<h1>Tabela de Produtos</h1>  
<?php
include('conexao.php');

$pesquisar = $_POST['pesquisar'];


$stmt = $conexao->prepare("SELECT nome, tipo FROM grupo WHERE nome LIKE ?");
$pesquisar = "%$pesquisar%";
$stmt->bind_param("s", $pesquisar);

$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo "<table class='table'><thead><tr><th>Nome</th><th>Tipo de Local</th><th></thead><tbody>";
    
    while ($row = $resultado->fetch_assoc()) {
        echo "<tr><td>".$row['nome']."</td>
        <td>".$row['tipo']."</td></tr>";
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