<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Pesquisar Produtos Cadastrados</h1>
    <form action="pesquisar.php" method="post">
        <label for="codigo_pesquisar">Código do Produto:</label>
        <input type="text" name="codigo_pesquisar" id="codigo_pesquisar">

        <label for="nome_pesquisar">Nome do Produto:</label>
        <input type="text" name="nome_pesquisar" id="nome_pesquisar">

        <label for="grupo_pesquisar">Grupo:</label>
        <input type="text" name="grupo_pesquisar" id="grupo_pesquisar">

        <label for="sub_grupo_pesquisar">Sub Grupo:</label>
        <input type="text" name="sub_grupo_pesquisar" id="sub_grupo_pesquisar">

        <input type="submit" value="Pesquisar">
    </form>
    <br><br>
    <?php 
    include("conexao.php");

    // Recebe os termos de pesquisa enviados pelo formulário
    $codigo = $_POST['codigo_pesquisar'] ?? '';
    $nome = $_POST['nome_pesquisar'] ?? '';
    $grupo = $_POST['grupo_pesquisar'] ?? '';
    $sub_grupo = $_POST['sub_grupo_pesquisar'] ?? '';

    // Atualizando a consulta SQL para buscar pelos critérios fornecidos
    $sql = "SELECT cod_produto, nome_produto, preco_custo, preco_venda, grupo 
            FROM produto 
            WHERE (cod_produto LIKE ? OR ? = '') 
              AND (nome_produto LIKE ? OR ? = '') 
              AND (grupo LIKE ? OR ? = '') 
              AND (sub_grupo LIKE ? OR ? = '')";

    $stmt = $conexao->prepare($sql);

    // Adiciona os caracteres coringa para a pesquisa e define parâmetros vazios como coringa
    $codigo = '%' . $codigo . '%';
    $nome = '%' . $nome . '%';
    $grupo = '%' . $grupo . '%';
    $sub_grupo = '%' . $sub_grupo . '%';

    $stmt->bind_param('ssssssss', $codigo, $codigo, $nome, $nome, $grupo, $grupo, $sub_grupo, $sub_grupo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "<table class='table'>
                <thead>
                    <tr>
                        <th>Código do Produto</th>
                        <th>Nome do Produto</th>
                        <th>Preço de Custo</th>
                        <th>Preço de Venda</th>
                        <th>Grupo</th>
                    </tr>
                </thead>
                <tbody>";
        
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['cod_produto']) . "</td>
                    <td>" . htmlspecialchars($row['nome_produto']) . "</td>
                    <td>" . htmlspecialchars($row['preco_custo']) . "</td>
                    <td>" . htmlspecialchars($row['preco_venda']) . "</td>
                    <td>" . htmlspecialchars($row['grupo']) . "</td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>Zero Resultados para a pesquisa.</p>";
    }

    $stmt->close();
    mysqli_close($conexao);
    ?>
</body>
</html>
