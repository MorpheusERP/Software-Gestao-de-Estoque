<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrada de Produtos - Busca/Entrada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="header">
        <h1>Cadastro</h1>
    </div>
    <div class="container">
        <div class="form">
            <div class="buttons">
                <button class="new" onclick="habilitarCampos()">Novo</button>
                <button class="search" onclick="window.location.href='pesquisar.php'">Buscar</button> <!-- Link para pesquisa -->
                <button class="edit" onclick="window.location.href='atualizacaodosdados.php'">Alterar</button> <!-- Link para atualização -->
            </div>

            <div class="image-placeholder">
                <img src="../../Entrada de Produtos/Fotos/Icone.png" alt="Imagem do Produto">
            </div>

            <!-- Formulário de Cadastro -->
            <form action="cadastro.php" method="POST" enctype="multipart/form-data" class="center-form">
                <label for="cod_produto">Código do Produto:</label>
                <input type="number" name="cod_produto" id="cod_produto" required class="form-control">
                <br>

                <label for="imagem">Imagem:</label>
                <input type="file" name="imagem" id="imagem" required class="form-control">
                <br>

                <label for="nome_produto">Nome do Produto:</label>
                <input type="text" name="nome_produto" id="nome_produto" required class="form-control">
                <br>

                <label for="tipo_produto">Tipo do Produto:</label>
                <input type="text" name="tipo_produto" id="tipo_produto" required class="form-control">
                <br>

                <label for="cod_barras">Código de Barras:</label>
                <input type="number" name="cod_barras" id="cod_barras" required class="form-control">
                <br>

                <label for="preco_custo">Preço de Custo:</label>
                <input type="number" name="preco_custo" id="preco_custo" step="0.01" required class="form-control">
                <br>

                <label for="preco_venda">Preço de Venda:</label>
                <input type="number" name="preco_venda" id="preco_venda" step="0.01" required class="form-control">
                <br>

                <label for="grupo">Grupo:</label>
                <input type="text" name="grupo" id="grupo" required class="form-control">
                <br>

                <label for="sub_grupo">Subgrupo:</label>
                <input type="text" name="sub_grupo" id="sub_grupo" required class="form-control">
                <br>

                <label for="observacao">Observação:</label>
                <textarea name="observacao" id="observacao" class="form-control"></textarea>
                <br>

                <div class="buttons-edit">
                    <button type="submit" class="edit">Salvar</button>
                </div>
            </form>
            
            <br><br>
            <!-- Espaço entre o formulário e a tabela -->
            <div style="margin-top: 30px;">
                <h1>Tabela de Produtos Cadastrados</h1>
                <br><br><br>
                <!-- Tabela de Produtos -->
                <?php 
                    include("conexao.php");

                    // Consulta SQL para incluir o campo da imagem
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
                            $imgTag = !empty($row['imagem']) 
                                ? "<img src='" . $row['imagem'] . "' width='100' height='100' alt='Imagem do Produto'/>" 
                                : "<span>Sem imagem</span>";

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
                        echo "<p>Zero Resultados</p>";
                    }

                    mysqli_close($conexao);
                ?>
            </div>
        </div>
    </div>
    <footer>
        <div class="BotoesFooter">
            <div class="buttons-search">
                <a href="../../Home Page/HTML/home.html">
                    <button class="search">Sair</button>
                </a>
            </div>
        </div>
    </footer>

    <div class="logo">
        <img src="../Imagens/Emporio maxx s-fundo.png" alt="Empório Maxx Logo">
    </div>
    <script>
        function habilitarCampos() {
            document.getElementById("codigo").disabled = false;
            document.getElementById("produto").disabled = false;
            document.getElementById("tipoQuantidade").disabled = false;
            document.getElementById("Custo").disabled = false;
            document.getElementById("Grupo").disabled = false;
            document.getElementById("Barras").disabled = false;
            document.getElementById("Venda").disabled = false;
            document.getElementById("SubGrupo").disabled = false;
            document.getElementById("observacoes").disabled = false;
        }
    </script>
</body>
</html>
