<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Saída de Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $id_saida = $_POST['NOVOid_saida'];
    $cod_produto = $_POST['NOVOcod_produto'];
    $nome_produto = $_POST['NOVOnome_produto'];
    $id_usuario = $_POST['NOVOid_usuario'];
    $nome_usuario = $_POST['NOVOnome_usuario'];
    $id_local = $_POST['NOVOid_local'];
    $preco_custo = $_POST['NOVOpreco_custo'];
    $nome_local = $_POST['NOVOnome_local'];
    $id_estoque = $_POST['NOVOid_estoque'];
    $qtd_saida = $_POST['NOVOqtd_saida'];
    $valor_total = $_POST['NOVOvalor_total'];
    $observacao = $_POST['NOVOobservacao'];
    $data_saida = $_POST['NOVOdata_saida']; // Verifica a data de saída enviada

    // Valida se a data está no formato correto (YYYY-MM-DD)
    if (!preg_match("/\d{4}-\d{2}-\d{2}/", $data_saida)) {
        die("Formato de data inválido. A data deve estar no formato YYYY-MM-DD.");
    } else {
        echo "Data de Saída recebida: " . htmlspecialchars($data_saida);
    }

    // Variável para o caminho da nova imagem
    $caminhoImagem = null;

    // Verifica se uma nova imagem foi enviada
    if (isset($_FILES['NOVOimagem']) && $_FILES['NOVOimagem']['error'] == 0) {
        // Verifica o tamanho do arquivo (máx. 2MB)
        if ($_FILES['NOVOimagem']['size'] > 2097152) {
            die("Arquivo muito grande! Max 2MB");
        }

        // Diretório para salvar as imagens
        $pasta = "imagem/"; // Certifique-se de que essa pasta exista

        // Nome único para o arquivo
        $novoNomeArquivo = uniqid();

        // Extensão do arquivo
        $extensao = strtolower(pathinfo($_FILES['NOVOimagem']['name'], PATHINFO_EXTENSION));

        // Define o caminho completo para salvar o arquivo
        $caminhoImagem = $pasta . $novoNomeArquivo . "." . $extensao;

        // Move o arquivo para o diretório de destino
        if (!move_uploaded_file($_FILES['NOVOimagem']['tmp_name'], $caminhoImagem)) {
            die("Falha ao mover o arquivo para o diretório");
        }
    }

    // Monta a query de atualização
    if ($caminhoImagem) {
        $sql = "UPDATE saida 
                SET imagem = ?, id_usuario = ?, nome_usuario = ?, cod_produto = ?, nome_produto = ?, id_local = ?, preco_custo = ?, nome_local = ?, id_estoque = ?, qtd_saida = ?, valor_total = ?, observacao = ?, data_saida = ?
                WHERE id_saida = ?";
        // Prepara a consulta
        $stmt = $conexao->prepare($sql);
        // Bind dos parâmetros
        $stmt->bind_param("ssssssssssssss",$caminhoImagem, $id_usuario, $nome_usuario, $cod_produto, $nome_produto, $id_local, $preco_custo, $nome_local, $id_estoque, $qtd_saida, $valor_total, $observacao, $data_saida, $id_saida);
    } else {
        $sql = "UPDATE saida 
                SET id_usuario = ?, nome_usuario = ?, cod_produto = ?, nome_produto = ?, id_local = ?, preco_custo = ?, nome_local = ?, id_estoque = ?, qtd_saida = ?, valor_total = ?, observacao = ?, data_saida = ?
                WHERE id_saida = ?";
        // Prepara a consulta
        $stmt = $conexao->prepare($sql);
        // Bind dos parâmetros sem imagem
        $stmt->bind_param($id_usuario, $nome_usuario, $cod_produto, $nome_produto, $id_local, $preco_custo, $nome_local, $id_estoque, $qtd_saida, $valor_total, $observacao, $data_saida, $id_saida);
    }

    // Executa a query
    if ($stmt->execute()) {
        echo "<br>Dados atualizados com sucesso!";
    } else {
        echo "<br>Erro ao atualizar dados: " . $conexao->error;
        echo "<br>SQL: " . $sql;
    }

    // Fecha a conexão
    $stmt->close();
    $conexao->close();
}
?>

</body>
</html>
