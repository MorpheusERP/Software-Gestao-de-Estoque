<?php
include("conexao.php");

// Verifique se os dados foram enviados corretamente
if (isset($_POST['nome_Local']) && isset($_POST['tipo_Local']) && isset($_POST['observacao'])) {
    $nome_Local = $_POST['nome_Local'];
    $tipo_Local = $_POST['tipo_Local'];
    $observacao = $_POST['observacao'];

    // Inserção de novos dados com o campo observacao, sem o campo id_Local
    $sql = "INSERT INTO local_destino (nome_Local, tipo_Local, observacao) VALUES ('$nome_Local', '$tipo_Local', '$observacao')";
    
    if (mysqli_query($conexao, $sql)) {
        echo "Dados salvos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . mysqli_error($conexao);
    }
} else {
    echo "Erro: Todos os campos são obrigatórios!";
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>
