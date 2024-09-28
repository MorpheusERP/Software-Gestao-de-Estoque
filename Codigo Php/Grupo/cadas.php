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
    <h1>Grupo/Sub Grupo</h1><br>
    <form action="cadastro.php" method="POST" class="center-form">
            <label for="ID">ID:</label>
            <input type="number" name="ID" id="ID" class="center-form" required>
            <br>
            <label for="nome">Grupo:</label>
            <input type="text" name="nome" id="nome" class="center-form" required>
            <br>
            <label for="tipo">Sub Grupo:</label>
            <input type="text" name="tipo" id="tipo" class="center-form" required>
            <br>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    <br>  
    <h2>Excluir Produto</h2>
    <form action="delet.php" method="post" class="delete-form">
        <label for="deletar"  >Digite o ID que deseja excluir</label>
        <input type="text" name="deletar" id="deletar" placeholder="Excluir" >
        <input type="submit" value="Excluir ID"  onclick="return confirm('Deseja realmente excluir o Produto?');">
    </form>
    <br>
    
    <br>

    <a href="atualizacaodegrupo.php" class="btn side-button">Atualizar</a>
    <br>
    <a href="pesquisar.html" class="btn side-button">Pesquisar</a>
    <br>

    
    <h2> Tabela de Produtos </h2>
    <?php
    include("conexao.php");

    $sql = "SELECT ID, nome, tipo FROM grupo";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><thead><tr><th>ID</th><th>Grupo</th><th>Sub Grupo</th></tr></thead><tbody>";
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr><td>".$row['ID']."</td>
            <td>".$row['nome']."</td>
            <td>".$row['tipo']."</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
    ?>

</body>
</html>
