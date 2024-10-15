<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Estoque</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo1.css">
</head>
<body>
    <h1>Atualizar dados no Estoque</h1>

    <?php 
    include("conexao.php");

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
    <br>

    <h2>Atualizar Estoque</h2>
    <form action="atualizar.php" method="POST" class="center-form">
        <label for="NOVOnivel">Nivel: </label>
        <input type="number" name="NOVOnivel" id="NOVOnivel" required>
        <br>
        <label for="NOVOnome">Nome: </label>
        <input type="text" name="NOVOnome" id="NOVOnome" required>
        <br>
        <label for="NOVOsobrenome">Sobrenome: </label>
        <input type="text" name="NOVOsobrenome" id="NOVOsobrenome" required>
        <br>
        <label for="NOVOfuncao">Função: </label>
        <input type="text" name="NOVOfuncao" id="NOVOfuncao" required>
        <br>
        <label for="NOVOlogi">Login: </label>
        <input type="text" name="NOVOlogi" id="NOVOlogi" required>
        <br>
        <label for="NOVOsenha">Senha: </label>
        <input type="text" name="NOVOsenha" id="NOVOsenha" required>
        <br>
        <button type="submit" class="btn btn-primary">Atualizar Dados</button>
    </form>
</body>
</html>
