<?php
    include("conexao.php");

    $ID = $_POST['ID'];
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $valor_compra = $_POST['valor_compra'];
    $valor_venda = $_POST['valor_venda'];
    $validade = $_POST['validade'];

    // Verifica se o ID já existe
    $check_sql = "SELECT ID FROM cadastro WHERE ID = ?";
    $stmt = mysqli_prepare($conexao, $check_sql);
    mysqli_stmt_bind_param($stmt, 's', $ID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "Erro: Este ID já está cadastrado.";
    } else {
        $sql = "INSERT INTO cadastro (ID, produto, quantidade, valor_compra, valor_venda, validade) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 'ssidds', $ID, $produto, $quantidade, $valor_compra, $valor_venda, $validade);

        if (mysqli_stmt_execute($stmt)) {
            echo "Produto cadastrado com sucesso";
        } else {
            echo "Erro: " . mysqli_error($conexao);
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
?>
 


