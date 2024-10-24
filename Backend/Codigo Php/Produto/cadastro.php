<?php
    include("conexao.php");

    $ID = $_POST['ID'];
    $nome = $_POST['nome'];
    $custo = $_POST['custo'];
    $venda = $_POST['venda'];
    $grupo = $_POST['grupo'];

    // Verifica se o ID já existe
    $check_sql = "SELECT ID FROM produto WHERE ID = ?";
    $stmt = mysqli_prepare($conexao, $check_sql);
    mysqli_stmt_bind_param($stmt, 's', $ID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "Erro: Este ID já está cadastrado.";
    } else {
        $sql = "INSERT INTO produto (ID, nome, custo, venda, grupo) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 'ssdds', $ID, $nome, $custo, $venda, $grupo);

        if (mysqli_stmt_execute($stmt)) {
            echo "Produto cadastrado com sucesso";
        } else {
            echo "Erro: " . mysqli_error($conexao);
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
?>
