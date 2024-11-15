<?php
session_start();

include '../conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['id_Usuario'])) {
    // Retorna uma resposta de erro se o usuário não estiver logado
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não logado']);
    exit;
}

// Pega o ID do usuário da sessão
    $idusuario = $_SESSION['id_Usuario'];

    // Prepara e executa a consulta SQL para verificar o usuário
    $sql = "SELECT nivel_Usuario, nome_Usuario, sobrenome, funcao, login FROM usuario WHERE id_Usuario = $idusuario";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    // Retorna os dados do usuário como JSON
    $dadosUsuario = $result->fetch_assoc();
    if ($dadosUsuario) {
        echo json_encode(['status' => 'sucesso', 'dados' => $dadosUsuario]);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não encontrado']);
    }