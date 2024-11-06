<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saída de Produtos</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
<body>
    <div class="container">
        <div class="header">
            <h1>Saída de Produtos</h1>
        </div>

        <form action="cadastro.php" method="post" enctype="multipart/form-data">
            <div class="form-container">
                <div class="image-placeholder">
                    <img src="../Imagens/Icone.png" alt="Imagem do Produto">
                </div>
                <div class="form">

                    <!-- ID do Usuário -->
                    <label for="id_usuario">ID do Usuário:</label>
                    <input type="number" name="id_usuario" id="id_usuario" class="input-field" placeholder="ID do Usuário" required>

                    <!-- Campo Código -->
                    <label for="codigo">Código:</label>
                    <div class="input-container">
                        <input type="number" name="cod_produto" id="codigo" class="input-field" placeholder="Código" required>
                        <button class="search-icon" type="button" onclick="searchCodigo()">🔍</button>
                    </div>

                    <!-- Campo Produto -->
                    <label for="produto">Produto:</label>
                    <div class="input-container">
                        <input type="text" name="nome_produto" id="produto" class="input-field" placeholder="Produto" required>
                        <button class="search-icon" type="button" onclick="searchProduto()">🔍</button>
                    </div>

                    <!-- Preço de Custo -->
                    <label for="preco_custo">Preço de Custo:</label>
                    <input type="number" step="0.01" name="preco_custo" id="preco_custo" class="input-field" placeholder="Preço de Custo" required>

                    <!-- Campo Local de Destino -->
                    <label for="local">Local de Destino (ID):</label>
                    <input type="number" name="id_local" id="id_local" class="input-field" placeholder="ID do Local" required>

                    <label for="nome_local">Nome do Local:</label>
                    <input type="text" name="nome_local" id="nome_local" class="input-field" placeholder="Nome do Local" required>

                    <!-- Quantidade -->
                    <label for="quantidade">Quantidade:</label>
                    <div class="quantidade-container">
                        <input type="number" name="qtd_saida" id="quantidade" placeholder="Quantidade" required>
                        <select name="tipoQuantidade" id="tipoQuantidade" required>
                            <option value="" disabled selected>Selecione o tipo</option>
                            <option value="Kilos">Kilos</option>
                            <option value="Caixas">Caixas</option>
                            <option value="Unidades">Unidades</option>
                            <option value="Sacos">Sacos</option>
                        </select>
                    </div>

                    <!-- Observações -->
                    <label for="observacoes">Observações:</label>
                    <textarea name="observacao" id="observacoes" placeholder="Observações"></textarea>

                    <!-- Imagem -->
                    <label for="imagem">Selecionar Imagem:</label>
                    <input type="file" name="imagem" id="imagem" accept="image/*" class="input-field">

                    <!-- Botões -->
                    <div class="buttons">
                        <button class="new" type="button" onclick="habilitarCampos()">Novo</button>
                        <button class="save" type="submit">Salvar</button>
                    </div>

                    <div>
                        <?php 
                        include("conexao.php");

                        $sql = "SELECT imagem, nome_produto, nome_local, qtd_saida FROM saida_produtos";
                        $resultado = mysqli_query($conexao, $sql);

                        if (mysqli_num_rows($resultado)) {
                            echo "<table class='table'>
                                    <thead>
                                        <tr>
                                            <th>Imagem</th>
                                            <th>Produto</th>
                                            <th>Local de Destino</th>
                                            <th>Quantidade</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            
                            while ($row = mysqli_fetch_assoc($resultado)) {
                                $imgTag = '';
                                if (!empty($row['imagem'])) {
                                    $imgTag = "<img src='" . $row['imagem'] . "' width='100' height='100' alt='Imagem do Produto' />";
                                } else {
                                    $imgTag = "<span>Sem imagem</span>";
                                }

                                echo "<tr>
                                        <td>" . $imgTag . "</td>
                                        <td>" . htmlspecialchars($row['nome_produto']) . "</td>
                                        <td>" . htmlspecialchars($row['nome_local']) . "</td>
                                        <td>" . htmlspecialchars($row['qtd_saida']) . "</td>
                                      </tr>";
                            }

                            echo "</tbody></table>";
                        } else {
                            echo "<p class='alert alert-warning'>Zero Resultados</p>";
                        }

                        mysqli_close($conexao);
                        ?>
                    </div> 
                </div>
            </div>
        </form>
        
        <div class="footer">
            <a href="../../Home Page/HTML/home.html" class="search-link">
                <button class="exit">Sair</button>
            </a>
            <div class="logo">
                <img src="../Imagens/Emporio maxx s-fundo.png" alt="Empório Maxx Logo">
            </div>
        </div>
    </div>

    <script>
        // Função para habilitar os campos bloqueados
        function habilitarCampos() {
            document.getElementById("quantidade").disabled = false;
            document.getElementById("tipoQuantidade").disabled = false;
            document.getElementById("observacoes").disabled = false;
        }

        function searchCodigo() {
            // Redireciona para a página de pesquisa de código
            window.location.href = "Produto.html";
        }

        function searchProduto() {
            // Lógica de pesquisa para o campo Produto
            window.location.href = "Produto.html";
        }

        function searchLocal() {
            // Lógica de pesquisa para o campo Local de Destino
            window.location.href = "Local.html";
        }
    </script>
</body>
</html>
