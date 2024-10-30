<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

<?php
include('conexao.php');

$pesquisar = $_POST['pesquisar'];

// Prepara a consulta para buscar os produtos com base no nome
$stmt = $conexao->prepare("SELECT id_Entrada, id_Usuario, nome_Usuario, id_Fornecedor, nome_Fornecedor, cod_Produto, nome_Produto, id_Estoque, qtd_Entrada, preco_Custo, sub_Grupo, valor_Total, data_Entrada FROM entrada_produtos WHERE nome_Produto LIKE ?");
$pesquisar = "%$pesquisar%"; // Adiciona os caracteres de wildcard para busca
$stmt->bind_param("s", $pesquisar);

$stmt->execute();
$resultado = $stmt->get_result();

if (mysqli_num_rows($resultado) > 0) {
    echo "<table class='table'><thead><tr>
        <th>ID Entrada</th>
        <th>ID Usuário</th>
        <th>Nome Usuário</th>
        <th>ID Fornecedor</th>
        <th>Nome Fornecedor</th>
        <th>Código Produto</th>
        <th>Nome Produto</th>
        <th>ID Estoque</th>
        <th>Quantidade Entrada</th>
        <th>Preço Custo</th>
        <th>Subgrupo</th>
        <th>Valor Total</th>
        <th>Data Entrada</th>
    </tr></thead><tbody>";
  
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
            <td>".$row['id_Entrada']."</td>
            <td>".$row['id_Usuario']."</td>
            <td>".$row['nome_Usuario']."</td>
            <td>".$row['id_Fornecedor']."</td>
            <td>".$row['nome_Fornecedor']."</td>
            <td>".$row['cod_Produto']."</td>
            <td>".$row['nome_Produto']."</td>
            <td>".$row['id_Estoque']."</td>
            <td>".$row['qtd_Entrada']."</td>
            <td>".$row['preco_Custo']."</td>
            <td>".$row['sub_Grupo']."</td>
            <td>".$row['valor_Total']."</td>
            <td>".$row['data_Entrada']."</td>
        </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "Zero Resultados";
}

mysqli_close($conexao);
?>
</body>
</html>
