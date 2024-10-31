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
        <label for="pesquisar">Pesquisar funcionário cadastrado</label>
        <input type="text" name="pesquisar" id="pesquisar">
        <input type="submit" value="Pesquisar">
    </form>

    <?php
    include('conexao.php');

    $pesquisar = $_POST['pesquisar'] ?? '';  // Verifica se o valor de 'pesquisar' foi enviado pelo formulário
    $pesquisar = "%$pesquisar%";  // Adiciona os curingas '%' para a pesquisa

    // Prepara a consulta SQL para buscar dados de acordo com o nome pesquisado
    $sql = "SELECT id_usuario, nivel_usuario, nome_usuario, sobrenome, funcao, logi, senha FROM usuario WHERE nome_usuario LIKE ?";
    $stmt = mysqli_prepare($conexao, $sql);  // Prepara a consulta
    mysqli_stmt_bind_param($stmt, 's', $pesquisar);  // Associa o parâmetro
    mysqli_stmt_execute($stmt);  // Executa a consulta
    $result = mysqli_stmt_get_result($stmt);  // Obtém o resultado da consulta

    if (mysqli_num_rows($result) > 0) {
        // Exibe a tabela com os dados obtidos
        echo "<table class='table'>
                <thead>
                    <tr>
                        <th>ID do Usuário</th>
                        <th>Nível</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Função</th>
                        <th>Login</th>
                        <th>Senha</th> <!-- Adiciona a coluna de senha -->
                    </tr>
                </thead>
                <tbody>";

        // Loop para exibir cada linha da tabela
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
            <td>" . htmlspecialchars($row['id_usuario']) . "</td>
            <td>" . htmlspecialchars($row['nivel_usuario']) . "</td>
            <td>" . htmlspecialchars($row['nome_usuario']) . "</td>
            <td>" . htmlspecialchars($row['sobrenome']) . "</td>
            <td>" . htmlspecialchars($row['funcao']) . "</td>
            <td>" . htmlspecialchars($row['logi']) . "</td>
            <td>****</td> <!-- Ocultando a senha -->
          </tr>";
        }

        echo "</tbody></table>";
    } else {
        // Exibe uma mensagem se não houver resultados
        echo "<p class='alert alert-warning'>Nenhum resultado encontrado.</p>";
    }

    // Libera o resultado e fecha a conexão com o banco de dados
    mysqli_free_result($result);
    mysqli_close($conexao);
    ?>
</body>
</html>
