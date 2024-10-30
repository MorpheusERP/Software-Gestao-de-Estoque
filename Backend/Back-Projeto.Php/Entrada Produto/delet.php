<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Dados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    
<?php
include('conexao.php');

// Verifica se o formulário foi enviado e se o campo 'id_Entrada' está definido
if (isset($_POST['id_Entrada'])) { // Removi a verificação de 'deletar' pois não é necessária
    $id_Entrada = $_POST['id_Entrada'];

    // Verifica se o produto existe antes de tentar deletar
    $sql_verificar = "SELECT * FROM entrada_produtos WHERE id_Entrada = ?";
    $stmt_verificar = mysqli_prepare($conexao, $sql_verificar);
    mysqli_stmt_bind_param($stmt_verificar, 'i', $id_Entrada); // Assumindo que id_Entrada é um inteiro
    mysqli_stmt_execute($stmt_verificar);
    $resultado_verificar = mysqli_stmt_get_result($stmt_verificar);

    if (mysqli_num_rows($resultado_verificar) > 0) {
        // Se o produto existir, realiza a exclusão
        $sql = "DELETE FROM entrada_produtos WHERE id_Entrada = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id_Entrada); // Assumindo que id_Entrada é um inteiro
        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            echo "<h1>Produto excluído com sucesso</h1>";
        } else {
            echo "<h1>Erro ao excluir o produto: " . mysqli_error($conexao) . "</h1>";
        }

        mysqli_stmt_close($stmt);
    } else {
        // Se o produto não existir, exibe mensagem de erro
        echo "<h1>Erro: Produto com ID $id_Entrada não encontrado</h1>";
    }

    mysqli_stmt_close($stmt_verificar);
} else {
    echo "<h1>Nenhum produto especificado para exclusão ou campo ID não enviado</h1>";
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>
</body>
</html>
