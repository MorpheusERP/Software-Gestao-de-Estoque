<?php

//Este arquivo serve para atualizar os dados do usuario, com base na requisição do arquivo PaginaUsuario.html
session_start();

include '../conexao.php';// Conexão com o banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION['id_Usuario'])) {
    // Retorna uma resposta de erro se o usuário não estiver logado
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não logado']);
    exit;
}

// Pega o ID do usuário da sessão
    $idusuario = $_SESSION['id_Usuario'];

// Recebe os dados JSON do corpo da requisição
$data = json_decode(file_get_contents('php://input'), true);

if (isset($idusuario)) {
    // Prepara a consulta de atualização
    $sql = "UPDATE usuario SET nome_Usuario = ?, sobrenome = ?, login = ?, senha = ? WHERE id_Usuario = $idusuario";
    $stmt = $mysqli->prepare($sql);
    $senhaHash = password_hash($data['senha'], PASSWORD_DEFAULT); // Hashing da senha

    // Vincula os parâmetros
    $stmt->bind_param("ssss", $data['nome'], $data['sobrenome'], $data['login'], $senhaHash);

    // Executa a consulta
    if ($stmt->execute()) {
        echo json_encode(["status" => "sucesso", "mensagem" => "Usuário atualizado com sucesso."]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar usuário: " . $stmt->error]);
    }
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Dados incompletos."]);
}

$stmt->close();
$mysqli->close();
?>
