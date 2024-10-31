<?php
include("conexao.php"); // Conexão com o banco de dados

// Coleta de dados do formulário
$nivel_usuario = $_POST['nivel_usuario']; // Atualizado para "nivel_usuario"
$nome_usuario = $_POST['nome_usuario']; // Atualizado para "nome_usuario"
$sobrenome = $_POST['sobrenome']; // Permanece como "sobrenome"
$funcao = $_POST['funcao']; // Permanece como "funcao"
$logi = $_POST['logi']; // Permanece como "logi"
$senha = $_POST['senha']; // Captura a senha diretamente

// Verifica se o login (logi) já existe
$check_logi_sql = "SELECT logi FROM usuario WHERE logi = ?";
$stmt = mysqli_prepare($conexao, $check_logi_sql);
mysqli_stmt_bind_param($stmt, "s", $logi); // "s" para string
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (!$resultado) {
    echo "Erro ao verificar o login: " . mysqli_error($conexao);
    exit;
}

if (mysqli_num_rows($resultado) > 0) {
    // Se o login já existir, retorne erro
    echo "Erro: Este login já está cadastrado.";
} else {
    // Caso o login seja novo, prossiga com o cadastro

    // Preparar a SQL para inserir o usuário no banco de dados (sem id_usuario)
    $sql = "INSERT INTO usuario (nivel_usuario, nome_usuario, sobrenome, funcao, logi, senha) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    
    // Executar a inserção e verifica se foi bem-sucedida
    mysqli_stmt_bind_param($stmt, "ssssss", $nivel_usuario, $nome_usuario, $sobrenome, $funcao, $logi, $senha);
    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo "Usuário cadastrado com sucesso.";
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }
}

// Fecha a conexão
mysqli_close($conexao);
?>
