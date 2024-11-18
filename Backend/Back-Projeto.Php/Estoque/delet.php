<!DOCTYPE html>
<html lang="pt-BR">
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

// Verifica se o formulário foi enviado e se o campo 'id_Estoque' está definido
if (isset($_POST['id_Estoque'])) {
    $id_Estoque = $_POST['id_Estoque'];

    // Verifica se a entrada existe antes de tentar deletar
    $sql_verificar = "SELECT * FROM estoque WHERE id_Estoque = ?"; 
    $stmt_verificar = mysqli_prepare($conexao, $sql_verificar);
    mysqli_stmt_bind_param($stmt_verificar, 'i', $id_Estoque); // Assumindo que id_Entrada é um inteiro
    mysqli_stmt_execute($stmt_verificar);
    $resultado_verificar = mysqli_stmt_get_result($stmt_verificar);

    if (mysqli_num_rows($resultado_verificar) > 0) {
        // Se a entrada existir, realiza a exclusão
        $sql = "DELETE FROM estoque WHERE id_Estoque = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id_Estoque); // Assumindo que id_Estoque é um inteiro
        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            echo "<h1> Excluída com sucesso</h1>";
        } else {
            echo "<h1>Erro ao excluir a entrada: " . mysqli_error($conexao) . "</h1>";
        }

        mysqli_stmt_close($stmt);
    } else {
        // Se a entrada não existir, exibe mensagem de erro
        echo "<h1>Erro: Entrada com ID $id_Estoque não encontrada</h1>";
    }

    mysqli_stmt_close($stmt_verificar);
} else {
    echo "<h1>Nenhuma entrada especificada para exclusão ou campo ID não enviado</h1>";
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>

</body>
</html>
