<?php
include("conexao.php");

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Método de requisição inválido");
    }
    
    // Validar dados recebidos
    $campos_requeridos = [
        'id_Usuario',
        'id_Fornecedor',
        'cod_Produto',
        'nome_Produto',
        'qtd_Entrada',
        'preco_Custo',
        'preco_Venda'
    ];
    
    $dados = [];
    foreach ($campos_requeridos as $campo) {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
            throw new Exception("Campo $campo é obrigatório");
        }
        $dados[$campo] = $_POST[$campo];
    }
    
    mysqli_begin_transaction($conexao);
    
    // Buscar nome do usuário
    $sql_usuario = "SELECT nome_Usuario FROM usuario WHERE id_Usuario = ?";
    $stmt = mysqli_prepare($conexao, $sql_usuario);
    mysqli_stmt_bind_param($stmt, 'i', $dados['id_Usuario']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) === 0) {
        throw new Exception("Usuário não encontrado");
    }
    $usuario = mysqli_fetch_assoc($result);
    $nome_Usuario = $usuario['nome_Usuario'];
    mysqli_stmt_close($stmt);
    
    // Buscar nome do fornecedor
    $sql_fornecedor = "SELECT razao_Social FROM fornecedor WHERE id_Fornecedor = ?";
    $stmt = mysqli_prepare($conexao, $sql_fornecedor);
    mysqli_stmt_bind_param($stmt, 'i', $dados['id_Fornecedor']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) === 0) {
        throw new Exception("Fornecedor não encontrado");
    }
    $fornecedor = mysqli_fetch_assoc($result);
    $razao_Social = $fornecedor['razao_Social'];
    mysqli_stmt_close($stmt);
    
    // Primeiro criar o registro na tabela estoque
    $sql_estoque = "INSERT INTO estoque (qtd_Estoque, cod_Produto) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexao, $sql_estoque);
    mysqli_stmt_bind_param($stmt, 'di', 
        $dados['qtd_Entrada'],
        $dados['cod_Produto']
    );
    
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Erro ao criar registro de estoque: " . mysqli_stmt_error($stmt));
    }
    
    $id_Estoque = mysqli_insert_id($conexao);
    mysqli_stmt_close($stmt);
    
    // Calcular valor total
    $valor_Total = $dados['qtd_Entrada'] * $dados['preco_Custo'];
    
    // Inserir na tabela entrada_produtos
    $sql_entrada = "INSERT INTO entrada_produtos (
        id_Usuario,
        nome_Usuario,
        id_Fornecedor,
        razao_Social,
        cod_Produto,
        nome_Produto,
        id_Estoque,
        qtd_Entrada,
        preco_Custo,
        valor_Total,
        data_Entrada
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURDATE())";
    
    $stmt = mysqli_prepare($conexao, $sql_entrada);
    if (!$stmt) {
        throw new Exception("Erro ao preparar query: " . mysqli_error($conexao));
    }
    
    mysqli_stmt_bind_param($stmt, 'isisisisdd', 
        $dados['id_Usuario'],
        $nome_Usuario,
        $dados['id_Fornecedor'],
        $razao_Social,
        $dados['cod_Produto'],
        $dados['nome_Produto'],
        $id_Estoque,
        $dados['qtd_Entrada'],
        $dados['preco_Custo'],
        $valor_Total
    );
    
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Erro ao inserir entrada: " . mysqli_stmt_error($stmt));
    }
    
    mysqli_commit($conexao);
    
    session_start();
    $_SESSION['mensagem'] = "Entrada de produto cadastrada com sucesso!";
    header("Location: pesquisar.php");
    exit();
    
} catch (Exception $e) {
    if (isset($conexao)) {
        mysqli_rollback($conexao);
    }
    
    error_log("Erro no cadastro de entrada de produto: " . $e->getMessage());
    
    session_start();
    $_SESSION['erro'] = "Erro ao cadastrar entrada de produto: " . $e->getMessage();
    header("Location: pesquisar.php");
    exit();
    
} finally {
    if (isset($stmt)) {
        mysqli_stmt_close($stmt);
    }
    if (isset($conexao)) {
        mysqli_close($conexao);
    }
}
?>