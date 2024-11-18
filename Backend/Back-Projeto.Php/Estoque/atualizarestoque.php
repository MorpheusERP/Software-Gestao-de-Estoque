<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="">
</head>
<body>
    <h1>Atualização de Produtos no Estoque</h1>

    <?php
    include("conexao.php");

    // Consulta para exibir todos os produtos cadastrados na tabela `estoque`
    $sql = "SELECT id_Estoque, cod_Produto, qtd_Estoque FROM estoque";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'>
                <thead>
                    <tr>
                        <th>ID Entrada</th>
                        <th>Código do Produto</th>
                        <th>Quantidade em Estoque</th>
                    </tr>
                </thead>
                <tbody>";
        
        // Exibe cada linha da tabela
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr>
                    <td>".$row['id_Estoque']."</td>
                    <td>".$row['cod_Produto']."</td>
                    <td>".$row['qtd_Estoque']."</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "Nenhum produto cadastrado no estoque.";
    }

    mysqli_close($conexao);
    ?>

    <br>

    <h2>Atualizar Produto</h2>
    <form action="atualizar_produto.php" method="POST" class="center-form">
        <label for="id_Estoque">ID Estoque:</label>
        <input type="number" name="id_Estoque" id="id_Estoque" class="form-control" required>
        <br>
        
        <label for="NOVOcod_Produto">Novo Código do Produto:</label>
        <input type="text" name="NOVOcod_Produto" id="NOVOcod_Produto" class="form-control" required>
        <br>
        
        <label for="NOVOqtd_Estoque">Nova Quantidade em Estoque:</label>
        <input type="number" name="NOVOqtd_Estoque" id="NOVOqtd_Estoque" class="form-control" required>
        <br>
        
        <button type="submit" class="btn btn-primary">Atualizar Dados</button>
    </form>
</body>
</html>
