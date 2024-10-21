<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    // Verifica se uma nova imagem foi enviada
    if (isset($_FILES['NOVOimagem']) && $_FILES['NOVOimagem']['error'] == 0) {
        $imagem = addslashes(file_get_contents($_FILES['NOVOimagem']['tmp_name']));

        // Monta a query de atualização com a imagem
        $sql = "UPDATE produto 
                SET imagem = ?, nome_produto = ?, tipo_produto = ?, cod_barras = ?, preco_custo = ?, preco_venda = ?, grupo = ?, sub_grupo = ?, observacao = ?
                WHERE cod_produto = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssssddsssi", $imagem, $nome_produto, $tipo_produto, $cod_barras, $preco_custo, $preco_venda, $grupo, $sub_grupo, $observacao, $cod_produto);
    } else {
        // Monta a query de atualização sem alterar a imagem
        $sql = "UPDATE produto 
                SET nome_produto = ?, tipo_produto = ?, cod_barras = ?, preco_custo = ?, preco_venda = ?, grupo = ?, sub_grupo = ?, observacao = ?
                WHERE cod_produto = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssddsssi", $nome_produto, $tipo_produto, $cod_barras, $preco_custo, $preco_venda, $grupo, $sub_grupo, $observacao, $cod_produto);
    }

    // Executa a query
    if ($stmt->execute()) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar dados: " . $conexao->error;
    }

    $stmt->close();
    $conexao->close();
}
?>

</body>
</html>
