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
<h1>Local de Destino</h1>
<form action="cadastro.php" method="POST" class="center-form">
    <label for="nome_Local">Nome Local: </label>
    <input type="text" name="nome_Local" id="nome_Local" class="form-control" required>
    <br>
    
    <label for="tipo_Local">Tipo Local: </label>
    <input type="text" name="tipo_Local" id="tipo_Local" class="form-control" required>
    <br>
    
    <label for="observacao">Observação: </label>
    <input type="text" name="observacao" id="observacao" class="form-control" required>
    <br>
    
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
<br>

<div id="tabelaCompras"></div>

<h2>Excluir Produto</h2>
<form action="delet.php" method="post" class="delete-form">
    <label for="nome_Local">Digite o Nome do Local que deseja excluir:</label>
    <input type="text" name="nome_Local" id="nome_Local" placeholder="Excluir" required>
    <input type="submit" value="Excluir" onclick="return confirm('Deseja realmente excluir o Produto?');">
</form>

<br>
<a href="pesquisar.php" class="btn btn-primary">Pesquisar Produto</a><br>
<br>
<a href="atualizarcaodeproduto.php" class="btn btn-primary">Atualizar Dados no Estoque</a><br>

<br>
<h2>Tabela de Produtos</h2><br>
<?php 
include ("conexao.php");

// Consulta ajustada para exibir somente os campos desejados
$sql = "SELECT nome_Local, tipo_Local, observacao FROM local_destino";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado)){
      echo "<table class='table'>
            <thead>
              <tr>
                <th>Nome Local</th>
                <th>Tipo Local</th>
                <th>Observação</th>
              </tr>
            </thead>
            <tbody>";
    
      // Exibe cada linha da tabela
      while ($row = mysqli_fetch_assoc($resultado)){
        echo "<tr>
                <td>".$row['nome_Local']."</td>
                <td>".$row['tipo_Local']."</td>
                <td>".$row['observacao']."</td>
              </tr>";
      }

      echo "</tbody></table>";
}
else{
    echo "Zero Resultados";
}

mysqli_close($conexao);
?>
</body>
</html>
