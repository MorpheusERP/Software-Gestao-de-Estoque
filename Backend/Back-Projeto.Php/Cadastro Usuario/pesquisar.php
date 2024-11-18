<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Pesquisar Funcionários</h1><br>
    <form action="" method="post">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" id="codigo"><br><br>

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome"><br><br>

        <label for="sobrenome">Sobrenome:</label>
        <input type="text" name="sobrenome" id="sobrenome"><br><br>

        <label for="funcao">Função:</label>
        <input type="text" name="funcao" id="funcao"><br><br>

        <input type="submit" value="Buscar">
    </form>
<br><br>
    <?php
    include('conexao.php');

    // Obtém os valores dos campos separadamente, adicionando '%' para busca parcial
    $codigo = "%" . ($_POST['codigo'] ?? '') . "%";
    $nome = "%" . ($_POST['nome'] ?? '') . "%";
    $sobrenome = "%" . ($_POST['sobrenome'] ?? '') . "%";
    $funcao = "%" . ($_POST['funcao'] ?? '') . "%";

    // Consulta SQL para buscar os registros que correspondem aos campos preenchidos
    $sql = "SELECT id_usuario, nome_usuario, sobrenome, funcao 
            FROM usuario 
            WHERE id_usuario LIKE ? 
              AND nome_usuario LIKE ? 
              AND sobrenome LIKE ? 
              AND funcao LIKE ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'ssss', $codigo, $nome, $sobrenome, $funcao);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table'>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Função</th>
                    </tr>
                </thead>
                <tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id_usuario']) . "</td>
                    <td>" . htmlspecialchars($row['nome_usuario']) . "</td>
                    <td>" . htmlspecialchars($row['sobrenome']) . "</td>
                    <td>" . htmlspecialchars($row['funcao']) . "</td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p class='alert alert-warning'>Nenhum resultado encontrado.</p>";
    }

    mysqli_free_result($result);
    mysqli_close($conexao);
    ?>
</body>
</html>
