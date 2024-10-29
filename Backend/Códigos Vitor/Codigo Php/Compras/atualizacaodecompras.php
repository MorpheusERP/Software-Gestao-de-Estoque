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
    <h1>Atualiza Tabela de Compras</h1>

    <?php 
    include("conexao.php");

    $sql = "SELECT fornecedor, produto, quantidade FROM compras";

    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><th>Fornecedor</th><th>Produto</th><th>Quantidade</th><th>";
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr><td>".$row['fornecedor']."</td>
            <td>".$row['produto']."</td>
            <td>".$row['quantidade']."</td></tr>";
        }

        echo "</table>";
    } else {
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
 ?>
 <br>

 <h2>Atualizar Estoque</h2>
    <form action="atualizar1.php" method="POST" class="center-form">
        <label for="NOVOfornecedor">Atualizar o fornecedor da tabela</label>
        <input type="text" name="NOVOfornecedor" id="NOVOfornecedor">
        <br>
        <label for="NOVOproduto">Produto: </label>
        <input type="text" name="NOVOproduto" id="NOVOproduto">
        <br>
        <label for="NOVOquantidade">Quantidade: </label>
        <input type="number" name="NOVOquantidade" id="NOVOquantidade">
        <br>
        <button>Atualizar Dados</button>
    </form>
</body>
</html>

