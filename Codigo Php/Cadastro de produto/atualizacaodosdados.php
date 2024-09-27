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
    include("conexao.php");

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
    <br>

    <h2>Atualizar Estoque</h2>
    <form action="atualizar.php" method="POST" class="center-form">
        <label for="NOVOID">ID do produto a ser atualizado</label>
        <input type="number" name="NOVOID" id="NOVOID">
        <br>
        <label for="NOVOproduto">Produto: </label>
        <input type="text" name="NOVOproduto" id="NOVOproduto">
        <br>
        <label for="NOVOquantidade">Quantidade: </label>
        <input type="number" name="NOVOquantidade" id="NOVOquantidade">
        <br>
        <label for="NOVOvalor_compra">Valor de Compra: </label>
        <input type="number" name="NOVOvalor_compra" id="NOVOvalor_compra" step="0.01">
        <br>
        <label for="NOVOvalor_venda">Valor de Venda: </label>
        <input type="number" name="NOVOvalor_venda" id="NOVOvalor_venda" step="0.01">
        <br>
        <label for="NOVOvalidade">Validade: </label>
        <input type="date" name="NOVOvalidade" id="NOVOvalidade">
        <br>
        <button>Atualizar Dados</button>
    </form>
</body>
</html>
