<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Entrada de Produto</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="">
</head>
<body>
<h1>Cadastro de Entrada de Produto</h1>
<form action="cadastro.php" method="POST" class="center-form">
    <label for="id_Estoque">ID Entrada: </label>
    <input type="number" name="id_Estoque" id="id_Estoque" class="form-control" required>
    <br>
    
    <label for="cod_Produto">Código do Produto: </label>
    <input type="number" name="cod_Produto" id="cod_Produto" class="form-control" required>
    <br>
    
    <label for="qtd_Estoque">Quantidade no Estoque: </label>
    <input type="number" name="qtd_Estoque" id="qtd_Estoque" step="0.01" class="form-control" required>
    <br>
    
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form> <br>

<h2>Excluir Entrada</h2>
<form action="delet.php" method="post" class="delete-form">
    <label for="id_Estoque">Digite o ID de Entrada que deseja excluir:</label>
    <input type="text" name="id_Estoque" id="id_Estoque" placeholder="Excluir" required>
    <input type="submit" value="Excluir ID" onclick="return confirm('Deseja realmente excluir a entrada?');">
</form>

<br>
<a href="pesquisar.php" class="btn btn-primary">Pesquisar Entrada</a><br>
<br>
<a href="atualizarestoque.php" class="btn btn-primary">Atualizar Dados no Estoque</a><br>

<br>
<h2>Tabela de Entradas</h2><br>
<?php 
include ("conexao.php");

// Consulta ajustada com a nova tabela 'entrada_produto'
$sql = "SELECT id_Estoque, cod_Produto, qtd_Estoque FROM estoque";

$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado)){
      echo "<table class='table'>
            <thead>
              <tr>
                <th>ID Entrada</th>
                <th>Código do Produto</th>
                <th>Quantidade no Estoque</th>
              </tr>
            </thead>
            <tbody>";
    
      // Exibe cada linha da tabela
      while ($row = mysqli_fetch_assoc($resultado)){
        echo "<tr>
                <td>".$row['id_Estoque']."</td>
                <td>".$row['cod_Produto']."</td>
                <td>".$row['qtd_Estoque']."</td>
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
