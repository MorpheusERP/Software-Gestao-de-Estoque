<?php

//Este arquivo serve para atualizar os dados do usuario, com base na requisição do arquivo alterarUsuario.html

include '../conexao.php';// Conexão com o banco de dados

// Recebe os dados JSON do corpo da requisição
$data = json_decode(file_get_contents('php://input'), true);

$id_Usuario = $data['id_Usuario'];
$nivel_Usuario = $data['nivel'] ?? null;
$nome_Usuario = $data['nome'];
$sobrenome = $data['sobrenome'] ?? null;
$funcao = $data['funcao'] ?? null;
$login = $data['login'];
$senha = $data['senha'] ?? null;

if ($id_Usuario) {
    try {
    if($senha){
        // Prepara a consulta de atualização
        $sql = "UPDATE usuario SET nivel_Usuario = ?, nome_Usuario = ?, sobrenome = ?, funcao = ?, login = ?, senha = ? WHERE id_Usuario = ?";
        $stmt = $mysqli->prepare( $sql);
        $senhaHash = password_hash($data['senha'], PASSWORD_DEFAULT); // Hashing da senha
        $stmt->bind_param("ssssssi", $data['nivel'], $data['nome'], $data['sobrenome'], $data['funcao'], $data['login'], $senhaHash, $data['id_Usuario']);
        if ($stmt->execute()) {
            echo json_encode(["status" => "sucesso", "mensagem" => "Usuário atualizado com sucesso."]);
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar usuário: " . $stmt->error]);
        }
    } else {
         // Prepara a consulta de atualização
         $sql = "UPDATE usuario SET nivel_Usuario = ?, nome_Usuario = ?, sobrenome = ?, funcao = ?, login = ? WHERE id_Usuario = ?";
         $stmt = $mysqli->prepare( $sql);
         $stmt->bind_param("sssssi", $data['nivel'], $data['nome'], $data['sobrenome'], $data['funcao'], $data['login'], $data['id_Usuario']);
         if ($stmt->execute()) {
             echo json_encode(["status" => "sucesso", "mensagem" => "Usuário atualizado com sucesso."]);
         } else {
             echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar usuário: " . $stmt->error]);
         }
    }
}catch (mysqli_sql_exception $e) {
    // Verifica se a mensagem de erro contém 'foreign key constraint fails'
    if (str_contains($e->getMessage(), 'foreign key constraint fails')) {
        echo json_encode([
            "status" => "erro",
            "mensagem" => "Não é possível excluir, ou atualizar o Usuario porque há registros vinculados a ele."
        ]);
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Erro ao atualizar fornecedor: " . $e->getMessage()]);
    }
}
} else {
echo json_encode(["status" => "erro", "mensagem" => "Dados incompletos."]);
}

$mysqli->close();
?>
