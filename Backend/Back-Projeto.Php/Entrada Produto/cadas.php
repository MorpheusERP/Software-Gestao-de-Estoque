<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
<h1>Cadastro de Entrada de Produto</h1>
<form action="cadastro.php" method="POST" class="center-form">
    <label for="nome_Fornecedor">Nome Fornecedor: </label>
    <input type="text" name="nome_Fornecedor" id="nome_Fornecedor" class="form-control" required>
    <br>
    
    <label for="nome_Produto">Nome Produto: </label>
    <input type="text" name="nome_Produto" id="nome_Produto" class="form-control" required>
    <br>
    
    <label for="cod_Produto">Código Produto: </label>
    <input type="number" name="cod_Produto" id="cod_Produto" class="form-control" required>
    <br>
    
    <label for="qtd_Entrada">Quantidade Entrada: </label>
    <input type="number" name="qtd_Entrada" id="qtd_Entrada" class="form-control" step="0.01" required>
    <br>
    
    <label for="preco_Custo">Preço Custo: </label>
    <input type="number" name="preco_Custo" id="preco_Custo" class="form-control" step="0.01" required>
    <br>
    
    <label for="preco_Venda">Preço Venda: </label>
    <input type="number" name="preco_Venda" id="preco_Venda" class="form-control" step="0.01" required>
    <br>
    
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form> <br>

<h2>Excluir Produto</h2>
<form action="delet.php" method="post" class="delete-form">
    <label for="id_Entrada">Digite o ID que deseja excluir:</label>
    <input type="text" name="id_Entrada" id="id_Entrada" placeholder="Excluir" required>
    <input type="submit" value="Excluir ID" onclick="return confirm('Deseja realmente excluir o Produto?');">
</form>

<br>
<a href="pesquisar1.php" class="btn btn-primary">Pesquisar Produto</a><br>
<br>
<a href="atualizarcaodeproduto.php" class="btn btn-primary">Atualizar Dados no Estoque</a><br>

<br>
<h2>Tabela de Produtos</h2><br>
<?php 
include("conexao.php");

// Consulta ajustada para incluir cod_Produto
$sql = "SELECT cod_Produto, nome_Produto, nome_Fornecedor, qtd_Entrada, preco_Custo, preco_Venda FROM entrada_produtos";

$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado)) {
    echo "<table class='table'>
            <thead>
              <tr>
                <th>Código Produto</th>
                <th>Produto</th>
                <th>Fornecedor</th>
                <th>Quantidade</th>
                <th>Preço de Custo</th>
                <th>Preço de Venda</th>
              </tr>
            </thead>
            <tbody>";

    // Exibe cada linha da tabela
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
                <td>".$row['cod_Produto']."</td>
                <td>".$row['nome_Produto']."</td>
                <td>".$row['nome_Fornecedor']."</td>
                <td>".$row['qtd_Entrada']."</td>
                <td>".$row['preco_Custo']."</td>
                <td>".$row['preco_Venda']."</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "Zero Resultados";
}

mysqli_close($conexao);
?>
</body>
</html>
