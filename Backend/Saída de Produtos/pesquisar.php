<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

    <h1 class="mt-5">Pesquisar Produtos Cadastrados</h1>
    <form action="pesquisar.php" method="post">
        <label for="pesquisar">Pesquisar os produtos na lista de Compras</label>
        <input type="text" class="form-control" name="pesquisar" id="pesquisar" required>

        <!-- Novos campos adicionados ao formulário -->
        <label for="fornecedor">Fornecedor</label>
        <input type="text" class="form-control" name="fornecedor" id="fornecedor">

        <label for="produto">Produto</label>
        <input type="text" class="form-control" name="produto" id="produto">

        <label for="grupo">Grupo</label>
        <input type="text" class="form-control" name="grupo" id="grupo">

        <label for="subgrupo">Subgrupo</label>
        <input type="text" class="form-control" name="subgrupo" id="subgrupo">

        <input type="submit" class="btn btn-primary mt-2" value="Pesquisar">
    </form>

    <?php 
    include("conexao.php");

    // Recebe o termo de pesquisa enviado pelo formulário
    $pesquisar = $_POST['pesquisar'] ?? ''; // Corrigido para o nome correto

    // Atualizando a consulta SQL para buscar produtos com os novos critérios
    $sql = "SELECT qtd_saida AS QTD_Produto, data_saida AS Periodo, nome_local AS Local_Destino 
            FROM saida_produtos 
            WHERE nome_produto LIKE ?"; // Adicionando condição de pesquisa

    $stmt = $conexao->prepare($sql);
    $pesquisar = '%' . $pesquisar . '%'; // Adiciona os caracteres coringa para a pesquisa
    $stmt->bind_param('s', $pesquisar);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "<table class='table'>
                <thead>
                    <tr>
                        <th>QTD_Produto</th> <!-- Alterado -->
                        <th>Período</th> <!-- Alterado -->
                        <th>Local de Destino</th> <!-- Alterado -->
                    </tr>
                </thead>
                <tbody>";
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['QTD_Produto']) . "</td> <!-- Alterado -->
                    <td>" . htmlspecialchars($row['Periodo']) . "</td> <!-- Alterado -->
                    <td>" . htmlspecialchars($row['Local_Destino']) . "</td> <!-- Alterado -->
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }

    $stmt->close();
    mysqli_close($conexao);
    ?>

</body>
</html>
