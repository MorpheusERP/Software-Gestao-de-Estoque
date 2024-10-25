<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Estoque</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo1.css">
</head>
<body>
    <h1>Atualizar dados no Estoque</h1>

    <?php 
    include ("conexao.php");

    $sql = "SELECT ID, nome, custo, venda, grupo FROM produto";

    $resultado = mysqli_query($conexao, $sql);

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
    <br>

    <h2>Atualizar Estoque</h2>
    <form action="atualizar.php" method="POST" class="center-form">
        <label for="NOVOID">ID do produto a ser atualizado:</label>
        <input type="number" name="NOVOID" id="NOVOID">
        <br>
        <label for="NOVOnome">Nome: </label>
        <input type="text" name="NOVOnome" id="NOVOnome">
        <br>
        <label for="NOVOcusto">P.Custo:</label>
        <input type="number" name="NOVOcusto" id="NOVOcusto" step="0.01">
        <br>
        <label for="NOVOvenda">P.Venda:</label>
        <input type="number" name="NOVOvenda" id="NOVOvenda" step="0.01">
        <br>
        <label for="NOVOgrupo">Grupo: </label>
        <input type="text" name="NOVOgrupo" id="NOVOgrupo">
        <br>
        <button>Atualizar</button>
    </form>
</body>
</html>