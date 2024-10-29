<?php
//Para executar esse arquivo é necessário alterar as credencais de conexão com o banco de dados
header('Content-Type: application/json'); // Define o cabeçalho para JSON

error_reporting(E_ALL); // Relatar todos os erros
ini_set('display_errors', 1); // Exibir erros

// Captura os dados enviados
$data = json_decode(file_get_contents("php://input")); // Decodifica o JSON

$login = $data->login; // Obtém o login do JSON
$senha = $data->senha; // Obtém a senha do JSON

// Conecte-se ao banco de dados
$mysqli = new mysqli("127.0.0.1", "root", "#$61@0Aljk", "teste_autenticacao");

// Verifica se houve erro na conexão
if ($mysqli->connect_error) {
    echo json_encode(["status" => "erro", "mensagem" => "Erro ao conectar ao banco de dados."]);
    exit(); // Encerra o script
}

// Prepara e executa a consulta SQL para verificar o usuário
$sql = "SELECT * FROM usuario WHERE login = ?";
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
