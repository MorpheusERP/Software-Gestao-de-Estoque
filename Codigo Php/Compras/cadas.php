<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>  	
    <h1>Compras</h1>
    <form action="cadastro1.php" method="POST" class="center-form">
        <label for="fornecedor">Fornecedor: </label>
        <input type="text" name="fornecedor" class="form-control"  placeholder="">
        <br>
        <label for="produto">Produto: </label>
        <input type="text" name="produto" class="form-control" placeholder="">
        <br>
        <label for="quantidade">Quantidade: </label>
        <input type="number" name="quantidade" class="form-control" placeholder="">
        <br>
       <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    <br>  
    <h2>Excluir Produto</h2>
    <form action="delet1.php" method="post" class="delete-form">
        <label for="deletar">Digite o Produto a ser excluido</label>
        <input type="text" name="deletar" id="deletar" placeholder="Excluir">
        <input type="submit" value="Excluir ID" onclick="return confirm('Deseja realmente excluir o Produto?');">
    </form>
    
    <br>

    <a href = "atualizacaodecompras.php" class="btn side-button">Atulizar Dados nas Compras</a>
    
    <br>

    <br>
    
    <a href = "pesquisar1.html" class="btn side-button">Pesquisar os produntos das Compras</a>
    
    <br>

    <?php
    include("conexao.php");

    $sql = "SELECT fornecedor, produto, quantidade FROM compras";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><thead><tr><th>Fornecedor</th><th>Produto</th><th>Quantidade</th></tr></thead><tbody>";
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr><td>".$row['fornecedor']."</td>
            <td>".$row['produto']."</td>
            <td>".$row['quantidade']."</td></tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
?>

</body>
</html>