<?php
// Configurações de conexão
$host = '127.0.0.1';
$user = 'root';
$password = '#$61@0Aljk';
$database = 'teste_autenticacao';

$mysqli = new mysqli($host, $user, $password, $database);

// Verifica a conexão
if ($mysqli->connect_error) {
    die('Erro de conexão: ' . $mysqli->connect_error);
}

// Para indicar que a conexão foi bem-sucedida
// echo "Conexão bem-sucedida!";

// Dados do usuário (esses dados geralmente viriam de um formulário)
$nivel_Usuario = "padrao";
$nome_Usuario = "Pablo";
$sobrenome = "Henrique";
$funcao = "Repositor";
$login = "Pablo";
$senha = "4321";

$mysqli = new mysqli($host, $user, $password, $database);

// Criptografa a senha usando password_hash
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Consulta SQL para inserir o usuário
$sql = "INSERT INTO usuario (nivel_Usuario, nome_Usuario, sobrenome, funcao, login, senha) VALUES (?, ?, ?, ?, ?, ?)";

// Prepara a declaração para evitar injeção de SQL
$stmt = $mysqli->prepare($sql);
if ($stmt) {
    // Associa os parâmetros e executa a declaração
    $stmt->bind_param("ssssss", $nivel_Usuario, $nome_Usuario, $sobrenome, $funcao, $login, $senhaHash);
    
    if ($stmt->execute()) {
        echo "Usuário adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar usuário: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Erro ao preparar a declaração: " . $mysqli->error;
}

// Fecha a conexão com o banco de dados
$mysqli->close();
?>

?>