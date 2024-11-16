<?php
session_start();

include '../conexao.php';// Conexão com o banco de dados

// Obtém as informações do usuário da sessão
$id_Usuario = $_SESSION['id_Usuario'];
$nome_Usuario = $_SESSION['usuario'];

// Obtém os dados enviados pelo JavaScript
$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos.']);
    exit;
}

// Calcula o valor total
$valor_Total = 0;
foreach ($data as $produtos) {
    $valor_Total += $produtos['qtd_Entrada'] * $produtos['preco_Custo'];
}

$valor_Lote = $valor_Total;

// Insere um novo registro na tabela `lote_entrada` para gerar um `id_Lote`
$stmtLote = $mysqli->prepare("INSERT INTO lote_entrada (id_Usuario, nome_Usuario, valor_Lote) VALUES (?, ?, ?)");
$stmtLote->bind_param("isd", $id_Usuario, $nome_Usuario, $valor_Lote);
$stmtLote->execute();
$id_Lote = $mysqli->insert_id;
$stmtLote->close();

if ($id_Lote) {
    // Insere cada produto na tabela `entrada_Produtos` usando o `id_Lote` gerado
    $stmtProdutos = $mysqli->prepare("INSERT INTO entrada_produtos (id_Fornecedor, razao_Social, cod_Produto, nome_Produto, qtd_Entrada, preco_Custo, id_Lote, grupo, sub_Grupo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    foreach ($data as $produtos) {

        // Consulta o `grupo` e `sub_Grupo` da tabela `produtos` usando `cod_Produto`
        $stmtBusca = $mysqli->prepare("SELECT grupo, sub_Grupo FROM produto WHERE cod_Produto = ?");
        $stmtBusca->bind_param("i", $produtos['cod_Produto']);
        $stmtBusca->execute();
        $stmtBusca->bind_result($grupo, $sub_Grupo);
        $stmtBusca->fetch();
        $stmtBusca->close();

        $stmtProdutos->bind_param(
            "isisddiss",
            $produtos['id_Fornecedor'],
            $produtos['razao_Social'],
            $produtos['cod_Produto'],
            $produtos['nome_Produto'],
            $produtos['qtd_Entrada'],
            $produtos['preco_Custo'],
            $id_Lote,
            $grupo,
            $sub_Grupo
        );
        $stmtProdutos->execute();
    }

    $stmtProdutos->close();

    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Entrada adicionada com sucesso!', 'id_Lote' => $id_Lote]);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao inserir o lote.']);
}

$mysqli->close();
?>
