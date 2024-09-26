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
    $nome = $_POST['NOVOnome'];
    $custo = $_POST['NOVOcusto'];
    $venda = $_POST['NOVOvenda'];
    $grupo = $_POST['NOVOgrupo'];

    // Atualiza os dados no banco de dados
    $stmt = $conexao->prepare("UPDATE produto SET nome = ?, custo = ?, venda = ?, grupo = ? WHERE ID = ?");
    $stmt->bind_param("sddsi", $nome, $custo, $venda, $grupo, $ID);

    if ($stmt->execute()) {
        echo "Dados atualizados no estoque.<br><br>";
    } else {
        echo "Erro na atualização do estoque: " . $stmt->error;
    }

    $stmt->close();

    // Seleciona e exibe os dados atualizados
    $sql = "SELECT ID, nome, custo, venda, grupo FROM produto";

    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
          echo "<table class='table'><thead><tr><th>ID</th><th>Nome</th><th>P. Custo</th><th>P. Venda</th><th>Grupo</th></tr></thead><tbody>";
        
          while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr><td>".$row['ID']."</td>
            <td>".$row['nome']."</td>
            <td>".$row['custo']."</td>
            <td>".$row['venda']."</td>
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
