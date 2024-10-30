<?php
    include("conexao.php");

    $nome_Fornecedor = $_POST['nome_Fornecedor'];
    $nome_Produto = $_POST['nome_Produto'];
    $qtd_Entrada = $_POST['qtd_Entrada'];
    $preco_Custo = $_POST['preco_Custo'];
    $preco_Venda = $_POST['preco_Venda'];  // Assumindo que preco_Venda está presente no formulário de entrada

    // Função para verificar duplicatas no código do produto
    function verificaCodigoProduto($conexao, $nome_Produto) {
        $sql = "SELECT nome_Produto FROM entrada_produtos WHERE nome_Produto = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 's', $nome_Produto);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            echo "Erro: Já existe um produto com esse nome cadastrado.<br>";
            mysqli_stmt_close($stmt);
            return true;
        }

        mysqli_stmt_close($stmt);
        return false;
    }

    // Verifica se já existe o nome do produto cadastrado
    if (verificaCodigoProduto($conexao, $nome_Produto)) {
        echo "Erro: Não foi possível cadastrar devido a duplicidade de produto.";
    } else {
        // Insere os dados na tabela entrada_produtos
        $sql = "INSERT INTO entrada_produtos (nome_Fornecedor, nome_Produto, qtd_Entrada, preco_Custo, preco_Venda) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 'ssidd', $nome_Fornecedor, $nome_Produto, $qtd_Entrada, $preco_Custo, $preco_Venda);

        if (mysqli_stmt_execute($stmt)) {
            echo "Entrada de produto cadastrada com sucesso.";
        } else {
            echo "Erro: " . mysqli_error($conexao);
        }

        mysqli_stmt_close($stmt);
    }

    // Fecha a conexão
    mysqli_close($conexao);
?>
