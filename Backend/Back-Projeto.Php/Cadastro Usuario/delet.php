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

<?php
    include('conexao.php'); // Inclui a conexão com o banco de dados MySQL

    $deletar = $_POST['deletar'] ?? ''; // Obtém o ID do usuário a ser excluído

    // Verifica se o ID não está vazio
    if (!empty($deletar)) {
        // Primeiro, verificar se o ID existe
        $sql_verifica = "SELECT * FROM usuario WHERE id_usuario = ?"; // Consulta para verificar se o ID existe
        $stmt_verifica = mysqli_prepare($conexao, $sql_verifica);
        mysqli_stmt_bind_param($stmt_verifica, "i", $deletar); // Vincula o ID do usuário
        mysqli_stmt_execute($stmt_verifica);
        $resultado_verifica = mysqli_stmt_get_result($stmt_verifica);

        if (mysqli_num_rows($resultado_verifica) > 0) {
            // Se o ID existe, realiza a exclusão
            $sql = "DELETE FROM usuario WHERE id_usuario = ?"; // Comando para deletar o usuário
            $stmt = mysqli_prepare($conexao, $sql);
            mysqli_stmt_bind_param($stmt, "i", $deletar); // Vincula o ID do usuário
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<h1>Usuário excluído com sucesso</h1>";
            } else {
                echo "<h1>Erro ao excluir o usuário</h1>" . mysqli_error($conexao);
            }

            // Fecha o statement de exclusão
            mysqli_stmt_close($stmt);
        } else {
            // Se o ID não existe, exibe uma mensagem de erro
            echo "<h1>Erro: Usuário não encontrado</h1>";
        }

        // Fecha o statement de verificação
        mysqli_stmt_close($stmt_verifica);
    } else {
        // Se o ID está vazio, exibe uma mensagem de erro
        echo "<h1>Erro: ID não fornecido</h1>";
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
?>
</body>
</html>
