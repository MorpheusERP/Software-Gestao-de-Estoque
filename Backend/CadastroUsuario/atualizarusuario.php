<?php

//Este arquivo serve para atualizar os dados do usuario, com base na requisição do arquivo alterarUsuario.html

include '../conexao.php';// Conexão com o banco de dados

// Recebe os dados JSON do corpo da requisição
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id_Usuario'])) {
    // Prepara a consulta de atualização
    $stmt = $mysqli->prepare("UPDATE usuario SET nivel_Usuario = ?, nome_Usuario = ?, sobrenome = ?, funcao = ?, login = ?, senha = ? WHERE id_Usuario = ?");
    $senhaHash = password_hash($data['senha'], PASSWORD_DEFAULT); // Hashing da senha

    // Vincula os parâmetros
    $stmt->bind_param("ssssssi", $data['nivel'], $data['nome'], $data['sobrenome'], $data['funcao'], $data['login'], $senhaHash, $data['id_Usuario']);

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
