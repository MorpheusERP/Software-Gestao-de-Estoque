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
    $pesquisar = $_POST['pesquisar'];

    // Corrigindo a consulta SQL
    $stmt = $conexao->prepare("SELECT id_saida, imagem, id_usuario, nome_usuario, cod_produto, nome_produto, id_local, preco_custo, nome_local, id_estoque, qtd_saida, valor_total, observacao, data_saida FROM saida WHERE nome_produto LIKE ?");
    $pesquisar = "%$pesquisar%";
    $stmt->bind_param("s", $pesquisar);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "<table class='table'>
                <thead>
                    <tr>
                        <th>ID Saída</th>
                        <th>Imagem</th>
                        <th>ID Usuário</th>
                        <th>Nome do Usuário</th>
                        <th>Código do Produto</th>
                        <th>Nome do Produto</th>
                        <th>ID Local</th>
                        <th>Preço de Custo</th>
                        <th>Nome do Local</th>
                        <th>ID Estoque</th>
                        <th>Quantidade de Saida</th>
                        <th>Valor Total</th>
                        <th>Observação</th>
                        <th>Data de Saída</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $resultado->fetch_assoc()) {
            // Verifica se a imagem existe e gera a tag img
            $imgTag = '';
            if (!empty($row['imagem'])) {
                $imgTag = "<img src='" . htmlspecialchars($row['imagem']) . "' width='100' height='100' alt='Imagem do Produto'/>";
            } else {
                $imgTag = "<span>Sem imagem</span>"; // Caso não tenha imagem
            }
            echo "<tr>
                    <td>" . htmlspecialchars($row['id_saida']) . "</td>
                    <td>" . $imgTag . "</td>
                    <td>" . htmlspecialchars($row['id_usuario']) . "</td>
                    <td>" . htmlspecialchars($row['nome_usuario']) . "</td>
                    <td>" . htmlspecialchars($row['cod_produto']) . "</td>
                    <td>" . htmlspecialchars($row['nome_produto']) . "</td>
                    <td>" . htmlspecialchars($row['id_local']) . "</td>
                    <td>" . htmlspecialchars($row['preco_custo']) . "</td>
                    <td>" . htmlspecialchars($row['nome_local']) . "</td>
                    <td>" . htmlspecialchars($row['id_estoque']) . "</td>
                    <td>" . htmlspecialchars($row['qtd_saida']) . "</td>
                    <td>" . htmlspecialchars($row['valor_total']) . "</td>
                    <td>" . htmlspecialchars($row['observacao']) . "</td>
                    <td>" . htmlspecialchars($row['data_saida']) . "</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }
    $stmt->close();
    $conexao->close();
    ?>
</body>
</html>
