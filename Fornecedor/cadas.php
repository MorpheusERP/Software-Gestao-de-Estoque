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
    <h1>Fornecedor</h1>
    <form action="cadastro.php" method="POST" class="center-form">
        <label for="razao">Razão Social: </label>
        <input type="text" name="razao" class="center-form" required>
        <br>
        <label for="fantasia">Nome Fantasia: </label>
        <input type="text" name="fantasia" class="center-form" required>
        <br>
        <label for="apelido">Apelido: </label>
        <input type="text" name="apelido" class="center-form" required>
        <br>
        <label for="grupo">Grupo: </label>
        <input type="text" name="grupo" class="center-form" required>
        <br>
        <button type="submit" class="btn side-button">Salvar</button>
    </form>
    <br>  
    <h2> Excluir </h2>
    <form action="delet.php" method="POST" class="delete-form">
        <label for="deletar">Digite o produnto que vc quer excluir</label>
        <input type="text" name="deletar" ID="deletar" placeholder="Excluir">
        <input type="submit" value="Excluir ID" onclick="return confirm('Deseja realmente excluir o Produto?');">
    </form>
    
    <br>

    <a href = "atualizacaodefornecedor.php" class= "btn side-button">Atulizar Dados</a>
    
    <br>

    <a href = "pesquisar.html" class="btn side-button">Pesquisar Produntos</a>
    
    <br>
     
    <h2> Tabel de Fornecedor </h2><br>
    
    <?php
    include("conexao.php");

    $sql = "SELECT razao, fantasia, apelido, grupo FROM fornecedor";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><thead><tr><th>Razão Social</th><th>Nome Fantasia</th><th>Apelido</th><th>Grupo</th></tr></thead><tbody>";
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr><td>".$row['razao']."</td>
            <td>".$row['fantasia']."</td>
            <td>".$row['apelido']."</td>
            <td>".$row['grupo']."</td></tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
?>


</body>
</html>