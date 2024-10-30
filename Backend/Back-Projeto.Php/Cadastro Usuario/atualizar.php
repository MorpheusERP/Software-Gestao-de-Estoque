<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

<?php
    include('conexao.php'); // Inclui o arquivo de conexão com o banco de dados MySQL
    
    // Captura de dados do formulário com prefixo NOVO
    $NOVOid_usuario = $_POST['NOVOid_usuario']; // ID do Usuário
    $NOVOnivel_usuario = $_POST['NOVOnivel_usuario']; // Nível
    $NOVOnome_usuario = $_POST['NOVOnome_usuario']; // Nome
    $NOVOsobrenome = $_POST['NOVOsobrenome']; // Sobrenome
    $NOVOfuncao = $_POST['NOVOfuncao']; // Função
    $NOVOlogi = $_POST['NOVOlogi']; // Login
    $NOVOsenha = $_POST['NOVOsenha']; // Senha

    // Prepara a consulta SQL para atualizar o usuário
    $sql = "UPDATE usuario SET nivel_usuario = ?, nome_usuario = ?, sobrenome = ?, funcao = ?, logi = ?, senha = ? WHERE id_usuario = ?";
    
    // Prepara a consulta com o MySQLi
    if ($stmt = mysqli_prepare($conexao, $sql)) {

        // Vincula os parâmetros à consulta
        mysqli_stmt_bind_param($stmt, "ssssssi", $NOVOnivel_usuario, $NOVOnome_usuario, $NOVOsobrenome, $NOVOfuncao, $NOVOlogi, $NOVOsenha, $NOVOid_usuario);

        // Executa a consulta
        if (mysqli_stmt_execute($stmt)) {
            echo "Dados atualizados com sucesso.<br><br>";
        } else {
            echo "Erro na atualização dos dados: " . mysqli_error($conexao);
        }

        // Fecha a declaração preparada
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro na preparação da consulta: " . mysqli_error($conexao);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);

?>
</body>
</html>
