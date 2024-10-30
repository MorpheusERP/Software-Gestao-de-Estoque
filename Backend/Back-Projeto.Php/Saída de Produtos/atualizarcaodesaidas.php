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
    <h1>Atualiza Saída de Produtos</h1>
    <?php
        include("conexao.php");
        // Consulta à tabela saida_produtos
        $sql = "SELECT id_saida, imagem, id_usuario, nome_usuario, cod_produto, nome_produto, id_local, preco_custo, nome_local, id_estoque, qtd_saida, valor_total, observacao, data_saida FROM saida_produtos";
        $resultado = mysqli_query($conexao, $sql);
        
        if (mysqli_num_rows($resultado) > 0) {
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
                            <th>Quantidade de Saída</th>
                            <th>Valor Total</th>
                            <th>Observação</th>
                            <th>Data de Saída</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = mysqli_fetch_assoc($resultado)) {
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
        mysqli_close($conexao);
    ?>
    <br>
    <h1>Atualizar Saída de Produtos</h1>
    <br>
    <form action="atualizar.php" method="POST" class="center-form" enctype="multipart/form-data">
        <label for="NOVOid_saida">ID Saída</label>
        <input type="text" name="NOVOid_saida" id="NOVOid_saida" class="form-control" required>
        <br>
        <label for="NOVOimagem">Imagem</label>
        <input type="file" name="NOVOimagem" id="NOVOimagem" class="form-control" accept="image/*">
        <br>
        <label for="NOVOid_usuario">ID Usuário</label>
        <input type="text" name="NOVOid_usuario" id="NOVOid_usuario" class="form-control" required>
        <br>
        <label for="NOVOnome_usuario">Nome do Usuário</label>
        <input type="text" name="NOVOnome_usuario" id="NOVOnome_usuario" class="form-control" required>
        <br>
        <label for="NOVOcod_produto">Código do Produto</label>
        <input type="text" name="NOVOcod_produto" id="NOVOcod_produto" class="form-control" required>
        <br>
        <label for="NOVOnome_produto">Nome do Produto</label>
        <input type="text" name="NOVOnome_produto" id="NOVOnome_produto" class="form-control" required>
        <br>
        <label for="NOVOid_local">ID Local</label>
        <input type="text" name="NOVOid_local" id="NOVOid_local" class="form-control" required>
        <br>
        <label for="NOVOpreco_custo">Preço de Custo</label>
        <input type="number" step="0.01" name="NOVOpreco_custo" id="NOVOpreco_custo" class="form-control" required>
        <br>
        <label for="NOVOnome_local">Nome do Local</label>
        <input type="text" name="NOVOnome_local" id="NOVOnome_local" class="form-control" required>
        <br>
        <label for="NOVOid_estoque">ID Estoque</label>
        <input type="text" name="NOVOid_estoque" id="NOVOid_estoque" class="form-control" required>
        <br>
        <label for="NOVOqtd_saida">Quantidade de Saída</label>
        <input type="number" step="0.01" name="NOVOqtd_saida" id="NOVOqtd_saida" class="form-control" required>
        <br>
        <label for="NOVOvalor_total">Valor Total</label>
        <input type="number" step="0.01" name="NOVOvalor_total" id="NOVOvalor_total" class="form-control" required>
        <br>
        <label for="NOVOobservacao">Observação</label>
        <input type="text" name="NOVOobservacao" id="NOVOobservacao" class="form-control">
        <br>
        <label for="NOVOdata_saida">Data de Saída</label>
        <input type="date" name="NOVOdata_saida" id="NOVOdata_saida" class="form-control" required>
        <br>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</body>
</html>
