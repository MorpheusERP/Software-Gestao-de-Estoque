<?php
include("conexao.php"); // Conexão com o banco de dados

// Coleta de dados do formulário
$nivel = $_POST['nivel'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$funcao = $_POST['funcao'];
$logi = $_POST['logi'];
$senha = $_POST['senha']; // Captura a senha diretamente

// Verifica se o login (logi) já existe
$check_logi_sql = "SELECT logi FROM usuario WHERE logi = ?";
$stmt = mysqli_prepare($conexao, $check_logi_sql);
mysqli_stmt_bind_param($stmt, 's', $logi); // Vincula o login ao parâmetro
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    // Se o login já existir, retorne erro
    echo "Erro: Este login já está cadastrado.";
} else {
    // Verifica se o nível já existe
    $check_nivel_sql = "SELECT nivel FROM usuario WHERE nivel = ?";
    $stmt = mysqli_prepare($conexao, $check_nivel_sql);
    mysqli_stmt_bind_param($stmt, 's', $nivel); // Vincula o nível ao parâmetro
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        // Se o nível já existir, retorne erro
        echo "Erro: Este nível já está cadastrado.";
    } else {
        // Caso o login e o nível sejam novos, prossiga com o cadastro

        // Preparar a SQL para inserir o usuário no banco de dados
        $sql = "INSERT INTO usuario (nivel, nome, sobrenome, funcao, logi, senha) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 'isssss', $nivel, $nome, $sobrenome, $funcao, $logi, $senha); // Usando a senha diretamente

        // Tenta executar a inserção e verifica se foi bem-sucedida
        if (mysqli_stmt_execute($stmt)) {
            echo "Usuário cadastrado com sucesso.";
        } else {
            echo "Erro ao cadastrar: " . mysqli_error($conexao);
        }
    }
}

// Fecha o statement e a conexão
mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>











