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

    $deletar = $_POST['deletar'];

    // Verifica se o produto (id_saida) existe antes de tentar deletar
    $sql_verificar = "SELECT * FROM saida WHERE id_saida = '$deletar'";
    $resultado_verificar = mysqli_query($conexao, $sql_verificar);

    if (mysqli_num_rows($resultado_verificar) > 0) {
        // Se o produto existir, realiza a exclusão
        $sql = "DELETE FROM saida WHERE id_saida = '$deletar'";
        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            echo "<h1>Produto excluído com sucesso</h1>";
        } else {
            echo "<h1>Erro ao excluir o produto: " . mysqli_error($conexao) . "</h1>";
        }
    } else {
        // Se o produto não existir, exibe mensagem de erro
        echo "<h1>Erro: Produto com ID $deletar não encontrado</h1>";
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
?>

</body>
</html>