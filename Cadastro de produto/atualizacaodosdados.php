<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Estoque</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Atualizar dados no Estoque</h1>

    <?php 
include("conexao.php");

// Atualizando a consulta SQL para incluir o campo da imagem
$sql = "SELECT cod_produto, imagem, nome_produto, tipo_produto, cod_barras, preco_custo, preco_venda, grupo, sub_grupo, observacao FROM produto";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado)) {
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
    echo "Zero Resultados";
}

mysqli_close($conexao);
?>

    <br>

    <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Estoque</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Atualizar dados no Estoque</h1>
<br>
    <form action="atualizar.php" method="POST" class="center-form" enctype="multipart/form-data" >
        <label for="NOVOcod_produto">Código do Produto:</label>
        <input type="number" name="NOVOcod_produto" id="NOVOcod_produto" required class="form-control">
        <br>

        <label for="NOVOnome_produto">Nome do Produto:</label>
        <input type="text" name="NOVOnome_produto" id="NOVOnome_produto" required class="form-control">
        <br>

        <label for="NOVOtipo_produto">Tipo do Produto:</label>
        <input type="text" name="NOVOtipo_produto" id="NOVOtipo_produto" required class="form-control">
        <br>

        <label for="NOVOcod_barras">Código de Barras:</label>
        <input type="text" name="NOVOcod_barras" id="NOVOcod_barras" required class="form-control">
        <br>

        <label for="NOVOpreco_custo">Preço de Custo:</label>
        <input type="number" name="NOVOpreco_custo" id="NOVOpreco_custo" step="0.01" required class="form-control">
        <br>

        <label for="NOVOpreco_venda">Preço de Venda:</label>
        <input type="number" name="NOVOpreco_venda" id="NOVOpreco_venda" step="0.01" required class="form-control">
        <br>

        <label for="NOVOgrupo">Grupo:</label>
        <input type="text" name="NOVOgrupo" id="NOVOgrupo" required class="form-control">
        <br>

        <label for="NOVOsub_grupo">Subgrupo:</label>
        <input type="text" name="NOVOsub_grupo" id="NOVOsub_grupo" required class="form-control">
        <br>

        <label for="NOVOobservacao">Observação:</label>
        <textarea name="NOVOobservacao" id="NOVOobservacao" required class="form-control"></textarea>
        <br>

        <button type="submit" class="btn btn-primary">Atualizar Dados</button>
    </form>
</body>
</html>

</body>
</html>
