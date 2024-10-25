<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo1.css">
</head>
<body>
    

<?php
    include('conexao.php');
     
    // Captura de dados do formulário
    $nivel = $_POST['NOVOnivel'];
    $nome = $_POST['NOVOnome'];
    $sobrenome = $_POST['NOVOsobrenome'];
    $funcao = $_POST['NOVOfuncao'];
    $logi = $_POST['NOVOlogi'];
    $senha = $_POST['NOVOsenha'];

    // Prepara a declaração SQL para atualizar o usuário
    $stmt = $conexao->prepare("UPDATE usuario SET nivel = ?, nome = ?, sobrenome = ?, funcao = ?, logi = ?, senha = ? WHERE nivel = ?");
    $stmt->bind_param("isssssi", $nivel, $nome, $sobrenome, $funcao, $logi, $senha, $nivel);

    // Verifica se a execução da query foi bem-sucedida
    if ($stmt->execute()) {
        echo "Dados atualizados no estoque.<br><br>";
    } else {
        echo "Erro na atualização do estoque: " . $stmt->error;
    }

    $stmt->close();

    // Seleciona todos os dados da tabela 'usuario'
    $sql = "SELECT nivel, nome, sobrenome, funcao, logi, senha FROM usuario";
    $resultado = mysqli_query($conexao, $sql);

    // Exibe os resultados em uma tabela
    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><thead><tr><th>Nível</th><th>Nome</th><th>Sobrenome</th><th>Função</th><th>Login</th><th>Senha</th></tr></thead><tbody>";
        
        // Loop para exibir cada linha
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr>
                <td>" . htmlspecialchars($row['nivel']) . "</td>
                <td>" . htmlspecialchars($row['nome']) . "</td>
                <td>" . htmlspecialchars($row['sobrenome']) . "</td>
                <td>" . htmlspecialchars($row['funcao']) . "</td>
                <td>" . htmlspecialchars($row['logi']) . "</td>
                <td>" . htmlspecialchars($row['senha']) . "</td>
            </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }

    // Fecha a conexão
    mysqli_close($conexao);
?>
</body>
</html>
