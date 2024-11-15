<?php

//Este arquivo serve para consultas de usuarios com id fornecido pelo arquivo alterarUsuarios.html

// Inclui o arquivo de conexão com o banco de dados
include '../conexao.php';

// Verifica se o ID do usuário foi passado como parâmetro
if (isset($_GET['id_Usuario'])) {
    // Obtém o ID do usuário fornecido
    $id_Usuario = $_GET['id_Usuario'];

    // Prepara a consulta para retornar apenas o usuário com o ID fornecido
    $sql = "SELECT nivel_Usuario, nome_Usuario, sobrenome, funcao, login FROM usuario WHERE id_Usuario = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id_Usuario); // 'i' indica que o parâmetro é um inteiro
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se encontrou o usuário
    if ($result->num_rows > 0) {
        // Retorna o usuário como JSON
        $usuario = $result->fetch_assoc();
        echo json_encode($usuario);
    } else {
        // Retorna mensagem de erro se o usuário não foi encontrado
        echo json_encode(["status" => "erro", "mensagem" => "Usuário não encontrado"]);
    }

    // Libera a consulta e fecha a conexão
    $stmt->close();
    $mysqli->close();
} else {
    // Retorna mensagem de erro se o ID do usuário não foi fornecido
    echo json_encode(["status" => "erro", "mensagem" => "ID de usuário não fornecido"]);
}
?>
