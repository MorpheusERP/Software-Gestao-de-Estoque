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
    include('conexao.php');

    // Recebe o ID do fornecedor a ser deletado
    $deletar = $_POST['deletar'];

    // Verifica se o ID existe antes de deletar
    $sql_verificar = "SELECT * FROM fornecedor WHERE id_fornecedor = '$deletar'";
    $resultado_verificar = mysqli_query($conexao, $sql_verificar);

    if (mysqli_num_rows($resultado_verificar) > 0) {
        // Se o ID existir, realiza a exclusão
        $sql = "DELETE FROM fornecedor WHERE id_fornecedor = '$deletar'";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            echo "<h1>Fornecedor excluído com sucesso</h1>";
        } else {
            echo "<h1>Erro ao excluir o fornecedor</h1>" . mysqli_error($conexao);
        }
    } else {
        // Se o ID não existir, exibe mensagem de erro
        echo "<h1>Erro: Fornecedor com ID $deletar não encontrado</h1>";
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
?>

</body>
</html>