<?php

//Este arquivo inicia a sessão de login e realiza a verificação do login e senha solicitados pelo arquivo index.html 

// Define o tempo da sessão em segundos
$tempoSessao = 28800; // 8 hora
ini_set('session.gc_maxlifetime', $tempoSessao);
session_set_cookie_params($tempoSessao);

session_start(); // Inicia a sessão

include '../conexao.php';

header('Content-Type: application/json'); // Define o cabeçalho para JSON

error_reporting(E_ALL); // Relatar todos os erros
ini_set('display_errors', 1); // Exibir erros

// Captura os dados enviados
$data = json_decode(file_get_contents("php://input")); // Decodifica o JSON

$login = $data->login; // Obtém o login do JSON
$senha = $data->senha; // Obtém a senha do JSON

// Prepara e executa a consulta SQL para verificar o usuário
$sql = "SELECT id_Usuario, nivel_Usuario, login, nome_Usuario, senha FROM usuario WHERE login = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se o usuário existe e a senha está correta
if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    // Verifica a senha e o nível de usuário
    if (password_verify($senha, $usuario['senha'])) {
        $nivelUsuario = $usuario['nivel_Usuario'] == 'admin' ? 'admin' : 'padrao';
        $nome_Usuario = $usuario['nome_Usuario'];

         // Armazena informações do usuário na sessão
         $_SESSION['logado'] = true;
         $_SESSION['id_Usuario'] = $usuario['id_Usuario'];
         $_SESSION['usuario'] = $usuario['nome_Usuario'];
         $_SESSION['nivel'] = $usuario['nivel_Usuario'];

        echo json_encode(["status" => "sucesso", "nivelUsuario" => $nivelUsuario]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Senha incorreta."]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Usuário não encontrado."]);
}

// Fecha a conexão com o banco de dados
$stmt->close();
$mysqli->close();
?>
