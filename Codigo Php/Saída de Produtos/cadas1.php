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
<h1>Saída de Produtos</h1><br>
<form action="cadastro2.php" method="POST" class="center-form">
    <label for="media">Média: </label>
    <input type="number" name="media" class="form-control">
    <br>
    <label for="produto">Produto: </label>
    <input type="text" name="produto" class="form-control">
    <br>
    <label for="locald">Local Destino: </label>
    <input type="text" name="locald" class="form-control">
    <br>
    <label for="quantidade">Quantidade: </label>
    <input type="number" name="quantidade" class="form-control">
    <br>
    <label for="nota">Observações:</label><br>
    <textarea id="nota" name="nota" rows="3" cols="73" placeholder="Escreva suas anotações aqui..."></textarea><br><br>
    <br>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>



    <br>  
    <form action="delet2.php" method="POST" class="delete-form">
        <label for="deletar">Digite o produnto que vc quer excluir</label>
        <input type="text" name="deletar" ID="deletar" placeholder="Excluir">
        <input type="submit" value="Excluir ID" onclick="return confirm('Deseja realmente excluir o Produto?');">
    </form>
    
    <br>

    <a href = "atualizarcaodesaidas.php" class="btn side-button">Atulizar de Saida</a><br>

    <br>
    
    <a href = "pesquisar2.html" class="btn side-button">Pesquisar</a><br>
     
    <br>

    <h2> Tabela de Produtos </h2>
    
    <br>

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

</body>
</html>