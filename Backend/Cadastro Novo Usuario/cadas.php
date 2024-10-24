
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
    <h1>Cadastro de Usuários</h1>
    <form action="cadastro.php" method="POST" class="center-form">
        <label for="nivel">Nivel: </label>
        <input type="number" name="nivel" id="nivel" class="center-form" required>
        <br>
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" class="center-form" required>
        <br>
        <label for="sobrenome">Sobrenome: </label>
        <input type="text" name="sobrenome" id="sobrenome" class="center-form">
        <br>
        <label for="funcao">Função: </label>
        <input type="text" name="funcao" id="funcao" class="center-form">
        <br>
        <label for="logi">Login: </label>
        <input type="text" name="logi" id="logi" class="center-form" required>
        <br>
        <label for="senha">Senha: </label>
        <input type="text" name="senha" id="senha" class="center-form" required>
        <br>
        <button type="submit" class="btn btn-primary">Cadastro</button>
    </form>
    <br>

    <div id="tabelaCompras"></div>

    <h2>Excluir Login</h2>
    <form action="delet.php" method="post" class="delete-form">
        <label for="deletar">Digite o ID que deseja excluir</label>
        <input type="text" name="deletar" id="deletar" placeholder="Excluir">
        <input type="submit" value="Excluir ID" onclick="return confirm('Deseja realmente excluir o Produto?');">
    </form>
    <br>
    <a href="pesquisar.html" class="btn btn-primary">Pesquisar Nome de Funcionarios</a><br>
    <br>
    <a href="atualizaocaodeusuario.php" class="btn btn-primary">Atualizar</a><br>

    <br>
    <h2>Tabela de Cadastro</h2><br>
    <?php 
    include ("conexao.php");

    $sql = "SELECT nivel, nome, sobrenome, funcao, logi, senha FROM usuario";

    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado)) {
        echo "<table class='table'><thead><tr><th>Nível</th><th>Nome</th><th>Sobrenome</th><th>Função</th><th>Login</th><th>Senha</th></tr></thead><tbody>";
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr><td>" . $row['nivel'] . "</td>
            <td>" . $row['nome'] ."</td>
            <td>" . $row['sobrenome'] ."</td>
            <td>" . $row['funcao'] . "</td>
            <td>" . $row['logi'] . "</td>
            <td>" . $row['senha'] . "</td></tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
  ?>
</body>
</html>
