<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
</head>
<body>
<h1>Cadastro do Produto</h1>
<form action="cadastro.php" method="POST" enctype="multipart/form-data" class="center-form"> <!-- enctype adicionado -->
    <label for="cod_produto">Código do Produto: </label>
    <input type="number" name="cod_produto" id="cod_produto" required class="form-control">
    <br>
    
    <label for="imagem">Imagem: </label>
    <input type="file" name="imagem" id="imagem" required class="form-control">
    <br>
    
    <label for="nome_produto">Nome do Produto: </label>
    <input type="text" name="nome_produto" id="nome_produto" required class="form-control">
    <br>
    
    <label for="tipo_produto">Tipo do Produto: </label>
    <input type="text" name="tipo_produto" id="tipo_produto" required class="form-control">
    <br>
    
    <label for="cod_barras">Código de Barras: </label>
    <input type="number" name="cod_barras" id="cod_barras" required class="form-control">
    <br>
    
    <label for="preco_custo">Preço de Custo: </label>
    <input type="number" name="preco_custo" id="preco_custo" step="0.01" required class="form-control">
    <br>
    
    <label for="preco_venda">Preço de Venda: </label>
    <input type="number" name="preco_venda" id="preco_venda" step="0.01" required class="form-control">
    <br>
    
    <label for="grupo">Grupo: </label>
    <input type="text" name="grupo" id="grupo" required class="form-control">
    <br>
    
    <label for="sub_grupo">Subgrupo: </label>
    <input type="text" name="sub_grupo" id="sub_grupo" required class="form-control">
    <br>
    
    <label for="observacao">Observação: </label>
    <textarea name="observacao" id="observacao" class="form-control"></textarea>
    <br>
    
    <button type="submit" class="btn btn-primary">Cadastro</button>
</form>

<br>

    <div id="tabelaCompras"></div><br>

<br>
    <h2>Excluir Produto</h2>
    <form action="delet.php" method="post" class="delete-form">
        <label for="deletar">Digite o ID que deseja excluir</label>
        <input type="text" name="deletar" ID="deletar" placeholder="Excluir">
        <input type="submit" value="Excluir ID" onclick="return confirm('Deseja realmente excluir o Produto?');">
    </form>
    <br>
    
    <a href = "pesquisar.html" class="btn btn-primary">Pesquisar Produnto</a><br>
    <br>
    <a href = "atualizacaodosdados.php" class="btn btn-primary">Atulizar Dados no Estoque</a><br>

    <br>
    <h2>Tabela de Produtos</h2><br>

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



</body>
</html>

