<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
</head>
<body>
    <h1>Cadastro do Usuário</h1>
    <form action="cadastro.php" method="POST" class="center-form">
        <label for="ID">ID: </label>
        <input type="number" name="ID" id="ID" required class="form-control">
        <br>
        <label for="produto">Produto: </label>
        <input type="text" name="produto" id="produto" required class="form-control">
        <br>
        <label for="quantidade">Quantidade: </label>
        <input type="number" name="quantidade" id="quantidade" required class="form-control" >
        <br>
        <label for="valor_compra">Valor de Compra: </label>
        <input type="number" name="valor_compra" id="valor_compra" step="0.01" required class="form-control" >
        <br>
        <label for="valor_venda">Valor de Venda: </label>
        <input type="number" name="valor_venda" id="valor_venda" step="0.01" required class="form-control">
        <br>
        <label for="validade">Validade: </label>
        <input type="date" name="validade" id="validade" required class="form-control">
        <br>
        <button type="submit"  class="btn btn-primary">Cadastro</button>
    </form><br>

    <div id="tabelaCompras"></div>

    <h2>Excluir Produto</h2>
    <form action="delet.php" method="post" class="delete-form">
        <label for="deletar">Digite o ID que deseja excluir</label>
        <input type="text" name="deletar" ID="deletar" placeholder="Excluir">
        <input type="submit" value="Excluir ID" onclick="return confirm('Deseja realmente excluir o Produto?');">
    </form>
    <br>

    <a href = "pesquisar.html" class="btn btn-primary">Pesquisar Produnto</a><br>
    <br>
    <a href = "atualizacaodosdados.php" class="btn btn-primary">Atulizar Dados no Estoque</a><br>

    <br>
    <h2>Tabela de Produtos</h2><br>
    <?php 
    include ("conexao.php");

    $sql = "SELECT ID, produto, quantidade, valor_compra, valor_venda, validade FROM cadastro";

    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado)){
          echo "<table class='table'><th> ID </th><th>Produto</th><th>Quantidade</th><th>Valor de Compra</th><th>Valor de Venda</th><th>Validade</th><tr>";
        
          while ($row=mysqli_fetch_assoc($resultado)){
            echo "<tr><td>".$row['ID']."</td>
            <td>".$row['produto']."</td>
            <td>".$row['quantidade']."</td>
            <td>".$row['valor_compra']."</td>
            <td>".$row['valor_venda']."</td>
            <td>".$row['validade']."</td></tr>";
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

