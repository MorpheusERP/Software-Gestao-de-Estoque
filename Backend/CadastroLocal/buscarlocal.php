<?php

//Este arquivo serve para consultas de Local de Destino com id fornecido pelo arquivo alterarLocal.html

// Inclui o arquivo de conexão com o banco de dados
include '../conexao.php';

// Verifica se o ID do usuário foi passado como parâmetro
if (isset($_GET['id_Local'])) {
    // Obtém o ID do usuário fornecido
    $id_Usuario = $_GET['id_Local'];

    // Prepara a consulta para retornar apenas o local com o ID fornecido
    $sql = "SELECT tipo_Local, nome_Local, observacao FROM local_destino WHERE id_Local = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id_Usuario); // 'i' indica que o parâmetro é um inteiro
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se encontrou o local de destino
    if ($result->num_rows > 0) {
        // Retorna o local de destino como JSON
        $local = $result->fetch_assoc();
        echo json_encode($local);
    } else {
        // Retorna mensagem de erro se o local de destino não foi encontrado
        echo json_encode(["status" => "erro", "mensagem" => "Local de Destino não encontrado"]);
    }

    // Libera a consulta e fecha a conexão
    $stmt->close();
    $mysqli->close();
} else {
    // Retorna mensagem de erro se o ID do local de destino não foi fornecido
    echo json_encode(["status" => "erro", "mensagem" => "ID do Local de Destino não fornecido"]);
}
?>
