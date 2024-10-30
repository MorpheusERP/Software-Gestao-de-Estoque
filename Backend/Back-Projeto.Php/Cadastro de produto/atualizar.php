<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $cod_produto = $_POST['NOVOcod_produto'];
    $nome_produto = $_POST['NOVOnome_produto'];
    $tipo_produto = $_POST['NOVOtipo_produto'];
    $cod_barras = $_POST['NOVOcod_barras'];
    $preco_custo = $_POST['NOVOpreco_custo'];
    $preco_venda = $_POST['NOVOpreco_venda'];
    $grupo = $_POST['NOVOgrupo'];
    $sub_grupo = $_POST['NOVOsub_grupo'];
    $observacao = $_POST['NOVOobservacao'];

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
        $sql = "UPDATE produto 
                SET imagem = ?, nome_produto = ?, tipo_produto = ?, cod_barras = ?, preco_custo = ?, preco_venda = ?, grupo = ?, sub_grupo = ?, observacao = ?
                WHERE cod_produto = ?";
        // Prepara a consulta
        $stmt = $conexao->prepare($sql);
        // Bind dos parâmetros
        $stmt->bind_param("ssssssssss", $caminhoImagem, $nome_produto, $tipo_produto, $cod_barras, $preco_custo, $preco_venda, $grupo, $sub_grupo, $observacao, $cod_produto);
    } else {
        $sql = "UPDATE produto 
                SET nome_produto = ?, tipo_produto = ?, cod_barras = ?, preco_custo = ?, preco_venda = ?, grupo = ?, sub_grupo = ?, observacao = ?
                WHERE cod_produto = ?";
        // Prepara a consulta
        $stmt = $conexao->prepare($sql);
        // Bind dos parâmetros sem imagem
        $stmt->bind_param("ssssssssi", $nome_produto, $tipo_produto, $cod_barras, $preco_custo, $preco_venda, $grupo, $sub_grupo, $observacao, $cod_produto);
    }

    // Executa a query
    if ($stmt->execute()) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar dados: " . $conexao->error;
    }

    // Fecha a conexão
    $stmt->close();
    $conexao->close();
}
?>

</body>
</html>
