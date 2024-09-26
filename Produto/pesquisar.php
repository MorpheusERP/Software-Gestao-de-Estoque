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

$stmt = $conexao->prepare("SELECT ID, nome, custo, venda, grupo FROM produto WHERE nome LIKE ?");
$pesquisar = "%$pesquisar%";
$stmt->bind_param("s", $pesquisar);

$stmt->execute();
$resultado = $stmt->get_result();

if (mysqli_num_rows($resultado)){
    echo "<table class='table'><th> ID </th><th>Nome</th><th>P.Custo</th><th>P.Venda</th><th>Grupo</th><tr>";
  
    while ($row=mysqli_fetch_assoc($resultado)){
      echo "<tr><td>".$row['ID']."</td>
      <td>".$row['nome']."</td>
      <td>".$row['custo']."</td>
      <td>".$row['venda']."</td>
      <td>".$row['grupo']."</td></tr>";
    }

    echo "</table>";
}
else{
  echo "Zero Resultados";
}

mysqli_close($conexao);

?>
</body>
</html>

