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

$pasta = "delet";
$deletar = $_POST['deletar'];

// Verifica se o ID existe na tabela 'saida'
$check_id_sql = "SELECT id_Saida FROM saida WHERE id_Saida = ?";
$stmt_check = mysqli_prepare($conexao, $check_id_sql);
mysqli_stmt_bind_param($stmt_check, 'i', $deletar);
mysqli_stmt_execute($stmt_check);
mysqli_stmt_store_result($stmt_check);

// Se o ID não existir, exibe mensagem
if (mysqli_stmt_num_rows($stmt_check) === 0) {
    echo "<h1>ID não encontrado</h1>";
} else {
    // Se o ID existe, realiza a exclusão
    $sql = "DELETE FROM saida WHERE id_Saida = ?";
    $stmt_delete = mysqli_prepare($conexao, $sql);
    
    if ($stmt_delete) {
        mysqli_stmt_bind_param($stmt_delete, 'i', $deletar);
        $resultado = mysqli_stmt_execute($stmt_delete);
        
        if ($resultado) {
            echo "<h1>Produto excluído com sucesso</h1>";
        } else {
            echo "<h1>Produto não foi excluído</h1>" . mysqli_error($conexao);
        }
    } else {
        echo "<h1>Erro ao preparar a consulta de exclusão</h1>" . mysqli_error($conexao);
    }
}

// Fecha as consultas preparadas e a conexão
mysqli_stmt_close($stmt_check);
if (isset($stmt_delete)) {
    mysqli_stmt_close($stmt_delete);
}
mysqli_close($conexao);
?>


</body>
</html>
