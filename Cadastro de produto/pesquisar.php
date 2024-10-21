<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

<?php 
include("conexao.php");

// Recebe o termo de pesquisa enviado pelo formulário
$pesquisar = $_POST['nome_pesquisar'] ?? ''; // Altera aqui para o nome correto

// Atualizando a consulta SQL para buscar apenas os produtos que contenham o termo pesquisado
$sql = "SELECT cod_produto, imagem, nome_produto, tipo_produto, cod_barras, preco_custo, preco_venda, grupo, sub_grupo, observacao 
        FROM produto 
        WHERE nome_produto LIKE ?";

$stmt = $conexao->prepare($sql);
$pesquisar = '%' . $pesquisar . '%'; // Adiciona os caracteres coringa para a pesquisa
$stmt->bind_param('s', $pesquisar);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo "<table class='table'>
            <thead>
                <tr>
                    <th>Código do Produto</th>
                    <th>Imagem</th>
                    <th>Nome do Produto</th>
                    <th>Tipo do Produto</th>
                    <th>Código de Barras</th>
                    <th>Preço de Custo</th>
                    <th>Preço de Venda</th>
                    <th>Grupo</th>
                    <th>Sub Grupo</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>";
    
    while ($row = mysqli_fetch_assoc($resultado)) {
        // Verifica se a imagem existe e gera a tag img
        $imgTag = '';
        if (!empty($row['imagem'])) {
            $imgTag = "<img src='" . $row['imagem'] . "' width='100' height='100' alt='Imagem do Produto'/>";
        } else {
            $imgTag = "<span>Sem imagem</span>"; // Caso não tenha imagem
        }

        echo "<tr>
                <td>" . htmlspecialchars($row['cod_produto']) . "</td>
                <td>" . $imgTag . "</td>
                <td>" . htmlspecialchars($row['nome_produto']) . "</td>
                <td>" . htmlspecialchars($row['tipo_produto']) . "</td>
                <td>" . htmlspecialchars($row['cod_barras']) . "</td>
                <td>" . htmlspecialchars($row['preco_custo']) . "</td>
                <td>" . htmlspecialchars($row['preco_venda']) . "</td>
                <td>" . htmlspecialchars($row['grupo']) . "</td>
                <td>" . htmlspecialchars($row['sub_grupo']) . "</td>
                <td>" . htmlspecialchars($row['observacao']) . "</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>Zero Resultados para a pesquisa de '$pesquisar'</p>";
}

$stmt->close();
mysqli_close($conexao);
?>

</body>
</html>
