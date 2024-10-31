<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
<h1>Saída de Produtos</h1><br>
<form action="cadastro.php" method="POST" enctype="multipart/form-data" class="center-form">
    <label for="id_saida">ID da Saída: </label>
    <input type="number" name="id_saida" id="id_saida" class="form-control">
    <br>
    
    <label for="imagem">Imagem: </label>
    <input type="file" name="imagem" id="imagem" class="form-control">
    <br>

    <label for="id_usuario">ID do Usuário: </label>
    <input type="number" name="id_usuario" id="id_usuario" class="form-control"> <!-- Corrigido -->
    <br>

    <label for="nome_usuario">Nome do Usuário: </label>
    <input type="text" name="nome_usuario" id="nome_usuario" class="form-control">
    <br>

    <label for="cod_produto">Código do Produto: </label>
    <input type="number" name="cod_produto" id="cod_produto" class="form-control">
    <br>

    <label for="nome_produto">Nome do Produto: </label>
    <input type="text" name="nome_produto" id="nome_produto" class="form-control">
    <br>

    <label for="id_local">ID do Local: </label>
    <input type="number" name="id_local" id="id_local" class="form-control">
    <br>

    <label for="preco_custo">Preço de Custo: </label>
    <input type="number" name="preco_custo" id="preco_custo" class="form-control" step="0.01">
    <br>

    <label for="nome_local">Nome do Local: </label>
    <input type="text" name="nome_local" id="nome_local" class="form-control">
    <br>

    <label for="id_estoque">ID do Estoque: </label>
    <input type="number" name="id_estoque" id="id_estoque" class="form-control">
    <br>

    <label for="qtd_saida">Quantidade de Saída: </label> <!-- Corrigido -->
    <input type="number" name="qtd_saida" id="qtd_saida" class="form-control" step="0.01">
    <br>

    <label for="valor_total">Valor Total: </label>
    <input type="number" name="valor_total" id="valor_total" class="form-control" step="0.01">
    <br>

    <label for="observacao">Observação: </label>
    <textarea type="text" name="observacao" id="observacao" class="form-control"></textarea>
    <br>
    

    <label for="data_saida">Data da Saída: </label>
    <input type="date" name="data_saida" id="data_saida" class="form-control">
    <br>
    
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>




    <br>  
    <form action="delet.php" method="POST" class="delete-form">
        <label for="deletar">Digite o ID que vc quer excluir</label>
        <input type="text" name="deletar" ID="deletar" placeholder="Excluir">
        <input type="submit" value="Excluir ID" onclick="return confirm('Deseja realmente excluir o Produto?');">
    </form>
    
    <br>

    <a href = "atualizarcaodesaidas.php" class="btn side-button">Atulizar de Saida</a><br>

    <br>
    
    <a href = "pesquisar.html" class="btn side-button">Pesquisar</a><br>
     
    <br>

    <h2> Tabela de Produtos </h2>
    
    <br>

    <?php 
include("conexao.php");

// Atualizando a consulta SQL para incluir os campos da imagem e as informações solicitadas
$sql = "SELECT id_saida, imagem, id_usuario, nome_usuario, cod_produto, nome_produto, id_local, preco_custo, nome_local, id_estoque, qtd_saida, valor_total, observacao, data_saida FROM saida";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado)) {
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
    
    while ($row = mysqli_fetch_assoc($resultado)) {
        // Verifica se a imagem existe e gera a tag img
        $imgTag = '';
        if (!empty($row['imagem'])) {
            $imgTag = "<img src='" . $row['imagem'] . "' width='100' height='100' alt='Imagem do Produto'/>";
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

</body>
</html>