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
    <h1>Atualiza Saida de Produtos</h1>

    <?php
        include("conexao.php");

        $sql = "SELECT media, produto, locald, quantidade FROM saida";
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            echo "<table class='table'><thead><tr><th>Média</th><th>Produto</th><th>Local Destino</th><th>Quantidade</th></tr></thead><tbody>";
            
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
 <br>
 <h1> Atualizar Saida de Produtos </h1>
 <form action="atualizar2.php" method="POST" class = "center-form">
        <label for="NOVOmedia">Atualiar as Media</label>
        <input type="text" name="NOVOmedia" id="NOVOmedia"  class="form-control">
        <br>
        <label for="NOVOproduto">Produto: </label>
        <input type="text" name="NOVOproduto" id="NOVOproduto"  class="form-control">
        <br>
        <label for="NOVOlocald">Local Destino: </label>
        <input type="text" name="NOVOlocald" id="NOVOlocald"  class="form-control">
        <br>
        <label for="NOVOquantidade">Quantidade: </label>
        <input type="number" name="NOVOquantidade" id="NOVOquantidade"  class="form-control">
        <br>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
   
</body>
</html>
