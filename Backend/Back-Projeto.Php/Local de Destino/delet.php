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

// Verifica se o formulário foi enviado e se o campo 'id_Local' está definido
if (isset($_POST['id_Local'])) { // Mudança de 'id_Entrada' para 'id_Local'
    $id_Local = $_POST['id_Local']; // Mudança de 'id_Entrada' para 'id_Local'

    // Verifica se o local existe antes de tentar deletar
    $sql_verificar = "SELECT * FROM local_destino WHERE id_Local = ?"; // Mudança de tabela
    $stmt_verificar = mysqli_prepare($conexao, $sql_verificar);
    mysqli_stmt_bind_param($stmt_verificar, 'i', $id_Local); // Assumindo que id_Local é um inteiro
    mysqli_stmt_execute($stmt_verificar);
    $resultado_verificar = mysqli_stmt_get_result($stmt_verificar);

    if (mysqli_num_rows($resultado_verificar) > 0) {
        // Se o local existir, realiza a exclusão
        $sql = "DELETE FROM local_destino WHERE id_Local = ?"; // Mudança de tabela
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id_Local); // Assumindo que id_Local é um inteiro
        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            echo "<h1>Local excluído com sucesso</h1>"; // Mudança de mensagem
        } else {
            echo "<h1>Erro ao excluir o local: " . mysqli_error($conexao) . "</h1>"; // Mudança de mensagem
        }

        mysqli_stmt_close($stmt);
    } else {
        // Se o local não existir, exibe mensagem de erro
        echo "<h1>Erro: Local com ID $id_Local não encontrado</h1>"; // Mudança de mensagem
    }

    mysqli_stmt_close($stmt_verificar);
} else {
    echo "<h1>Nenhum local especificado para exclusão ou campo ID não enviado</h1>"; // Mudança de mensagem
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>

</body>
</html>
