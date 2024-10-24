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
</head>
<body>
    <h1>Produto</h1>
    <form action="cadastro.php" method="POST" class="center-form">
        <label for="ID">ID: </label>
        <input type="number" name="ID" id="ID" class="center-form" required>
        <br>
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" class="center-form" required>
        <br>
        <label for="custo">P.Custo: </label>
        <input type="number" name="custo" id="custo" class="center-form" step="0.01" required>
        <br>
        <label for="venda">P.Venda: </label>
        <input type="number" name="venda" id="venda" class="center-form" step="0.01" required>
        <br>
        <label for="grupo">Grupo: </label>
        <input type="text" name="grupo" id="grupo" class="center-form" required>
        <br>
        <button type="submit"  class="btn btn-primary" >Cadastro</button>
    </form><br>

    <div id="tabelaCompras"></div>

    <h2>Excluir Produto</h2>
    <form action="delet.php" method="post" class="delete-form">
        <label for="deletar">Digite o ID que deseja excluir</label>
        <input type="text" name="deletar" id="deletar" placeholder="Excluir">
        <input type="submit" value="Excluir ID" onclick="return confirm('Deseja realmente excluir o Produto?');">
    </form>
    <br>
    <a href = "pesquisar.html" class="btn btn-primary">Pesquisar Produnto</a><br>
    <br>
    <a href = "atualizarcaodeproduto.php" class="btn btn-primary">Atulizar Dados no Estoque</a><br>

    <br>
    <h2>Tabela de Produtos</h2><br>
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
</body>
</html>