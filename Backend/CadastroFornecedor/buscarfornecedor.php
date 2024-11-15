<?php

//Este arquivo serve para consultas de Fornecedor com id fornecido pelo arquivo alterarFornecedor.html

// Inclui o arquivo de conexão com o banco de dados
include '../conexao.php';

// Verifica se o ID do fornecedor foi passado como parâmetro
if (isset($_GET['id_Fornecedor'])) {
    // Obtém o ID do fornecedor fornecido
    $id_Fornecedor = $_GET['id_Fornecedor'];

    // Prepara a consulta para retornar apenas o Fornecedor com o ID fornecido
    $sql = "SELECT razao_Social, nome_Fantasia, apelido, grupo, sub_Grupo, observacao FROM fornecedor WHERE id_Fornecedor = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id_Fornecedor); // 'i' indica que o parâmetro é um inteiro
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se encontrou o fornecedor
    if ($result->num_rows > 0) {
        // Retorna o fornecedor como JSON
        $fornecedor = $result->fetch_assoc();
        echo json_encode($fornecedor);
    } else {
        // Retorna mensagem de erro se o fornecedor não foi encontrado
        echo json_encode(["status" => "erro", "mensagem" => "Fornecedor não encontrado"]);
    }

    // Libera a consulta e fecha a conexão
    $stmt->close();
    $mysqli->close();
} else {
    // Retorna mensagem de erro se o ID do Fornecedor não foi fornecido
    echo json_encode(["status" => "erro", "mensagem" => "ID de Fornecedor não fornecido"]);
}
?>
