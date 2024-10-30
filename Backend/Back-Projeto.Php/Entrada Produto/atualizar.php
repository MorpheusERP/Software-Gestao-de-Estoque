<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Dados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

<?php
    include('conexao.php');

    // Captura as informações do formulário
    $id_Entrada = $_POST['NOVOid_Entrada'];      // ID da entrada
    $id_Usuario = $_POST['NOVOid_Usuario'];      // ID do usuário
    $nome_Usuario = $_POST['NOVOnome_Usuario'];  // Nome do usuário
    $id_Fornecedor = $_POST['NOVOid_Fornecedor']; // ID do fornecedor
    $nome_Fornecedor = $_POST['NOVOnome_Fornecedor']; // Nome do fornecedor
    $cod_Produto = $_POST['NOVOcod_Produto'];    // Código do produto
    $nome_Produto = $_POST['NOVOnome_Produto'];  // Nome do produto
    $id_Estoque = $_POST['NOVOid_Estoque'];      // ID do estoque
    $qtd_Entrada = $_POST['NOVOqtd_Entrada'];    // Quantidade da entrada
    $preco_Custo = $_POST['NOVOpreco_Custo'];    // Preço de custo
    $sub_Grupo = $_POST['NOVOsub_Grupo'];        // Subgrupo
    $valor_Total = $_POST['NOVOvalor_Total'];    // Valor total
    $data_Entrada = $_POST['NOVOdata_Entrada'];  // Data da entrada

    // Verifica se os dados foram recebidos corretamente
    if (empty($id_Entrada) || empty($id_Usuario) || empty($id_Fornecedor) || empty($cod_Produto)) {
        echo "Erro: Por favor, preencha todos os campos obrigatórios.";
        exit; // Interrompe a execução se os campos obrigatórios estiverem vazios
    }

    // Atualiza os dados no banco de dados
    $stmt = $conexao->prepare("UPDATE entrada_produtos SET 
        id_Usuario = ?, 
        nome_Usuario = ?, 
        id_Fornecedor = ?, 
        nome_Fornecedor = ?, 
        cod_Produto = ?, 
        nome_Produto = ?, 
        id_Estoque = ?, 
        qtd_Entrada = ?, 
        preco_Custo = ?, 
        sub_Grupo = ?, 
        valor_Total = ?, 
        data_Entrada = ? 
        WHERE id_Entrada = ?");

    // Atribui os parâmetros à consulta
    // String de tipos: "iisisssiddssd" significa:
    // i: inteiro (id_Usuario, id_Fornecedor, id_Estoque, qtd_Entrada, id_Entrada)
    // s: string (nome_Usuario, nome_Fornecedor, cod_Produto, nome_Produto, sub_Grupo, data_Entrada)
    // d: decimal (preco_Custo, valor_Total)
    $stmt->bind_param("sssssssssssss", $id_Usuario, $nome_Usuario, $id_Fornecedor, $nome_Fornecedor, $cod_Produto, $nome_Produto, $id_Estoque, $qtd_Entrada, $preco_Custo, $sub_Grupo, $valor_Total, $data_Entrada, $id_Entrada);

    if ($stmt->execute()) {
        echo "Dados atualizados no estoque.<br><br>";
    } else {
        echo "Erro na atualização do estoque: " . $stmt->error;
    }

    $stmt->close();
    mysqli_close($conexao);
?>
</body>
</html>
