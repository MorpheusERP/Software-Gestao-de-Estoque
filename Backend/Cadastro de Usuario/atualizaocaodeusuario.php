<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Estoque</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Tabela de Usuarios</h1>

    <?php 
    include("conexao.php");

    // Consulta SQL ajustada para o MySQL
    $sql = "SELECT id_usuario, nivel_usuario, nome_usuario, sobrenome, funcao, logi, senha FROM usuario";
    $resultado = mysqli_query($conexao, $sql);

    // Verifica se a consulta foi bem-sucedida
    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }

    // Verifica se a consulta retorna resultados
    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table table-striped'>
                <thead>
                    <tr>
                        <th>ID do Usuário</th>
                        <th>Nível</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Função</th>
                        <th>Login</th>
                        <th>Senha</th> <!-- Adicionando coluna para senha -->
                    </tr>
                </thead>
                <tbody>";
        
        // Loop pelos resultados e exibição na tabela
        while ($row = mysqli_fetch_assoc($resultado)) {
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
        echo "<p>Zero Resultados</p>";
    }

    // Fechar a conexão
    mysqli_close($conexao);
?>

    <br>

    <div class="container mt-5 d-flex justify-content-center">
        <div class="col-md-6"> <!-- Limita a largura do formulário para centralizá-lo -->
            <h1 class="text-center">Atualizar Dados</h1><br><br>
            <form action="atualizar.php" method="POST">

                <div class="form-group">
                    <label for="NOVOid_usuario">ID do Usuário:</label>
                    <input type="number" name="NOVOid_usuario" id="NOVOid_usuario" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="NOVOnivel_usuario">Nível de Usuário:</label>
                    <select id="NOVOnivel_usuario" name="NOVOnivel_usuario" class="form-control" required>
                        <option value="" disabled selected>* Selecione o Nível de Usuário</option>
                        <option value="Padrao">Padrão</option>
                        <option value="Adm">Administrador</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="NOVOnome_usuario">Nome:</label>
                    <input type="text" name="NOVOnome_usuario" id="NOVOnome_usuario" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="NOVOsobrenome">Sobrenome:</label>
                    <input type="text" name="NOVOsobrenome" id="NOVOsobrenome" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="NOVOfuncao">Função:</label>
                    <input type="text" name="NOVOfuncao" id="NOVOfuncao" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="NOVOlogi">Login:</label>
                    <input type="text" name="NOVOlogi" id="NOVOlogi" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="NOVOsenha">Senha:</label>
                    <input type="password" name="NOVOsenha" id="NOVOsenha" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Atualizar Dados</button><br><br><br>
            </form>
        </div>
    </div>

</body>
</html>
