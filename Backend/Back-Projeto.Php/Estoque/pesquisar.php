<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Pesquisar Produtos Cadastrados</h1>
    <form action="" method="post">
        <label for="pesquisar">Pesquisar os produtos na lista de Compras</label>
        <input type="text" name="pesquisar" id="pesquisar">
        <input type="submit" value="Pesquisar">
    </form>

    <?php
    include('conexao.php');

    // Verifica se o campo 'pesquisar' foi enviado e não está vazio
    if (isset($_POST['pesquisar']) && !empty($_POST['pesquisar'])) {
        $pesquisar = $_POST['pesquisar'];

        // Consulta para buscar dados específicos na tabela `estoque`
        $stmt = $conexao->prepare("SELECT id_Entrada, cod_Produto, qtd_Estoque FROM estoque WHERE cod_Produto LIKE ?");
        $pesquisar = "%$pesquisar%";
        $stmt->bind_param("s", $pesquisar);

        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            echo "<h2>Resultados da Pesquisa:</h2>";
            echo "<table class='table'><thead><tr><th>ID Entrada</th><th>Código do Produto</th><th>Quantidade em Estoque</th></tr></thead><tbody>";
            
            while ($row = $resultado->fetch_assoc()) {
                echo "<tr><td>".$row['id_Entrada']."</td>
                <td>".$row['cod_Produto']."</td>
                <td>".$row['qtd_Estoque']."</td></tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "Zero Resultados na pesquisa.";
        }

        $stmt->close();
    } else {
        // Consulta para exibir todos os dados inicialmente, apenas se não houver pesquisa
        $sql = "SELECT id_Entrada, cod_Produto, qtd_Estoque FROM estoque";
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            echo "<h2>Tabela de Produtos Cadastrados:</h2>";
            echo "<table class='table'><thead><tr><th>ID Entrada</th><th>Código do Produto</th><th>Quantidade em Estoque</th></tr></thead><tbody>";
            
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr><td>".$row['id_Entrada']."</td>
                <td>".$row['cod_Produto']."</td>
                <td>".$row['qtd_Estoque']."</td></tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "Zero Resultados.";
        }
    }

    mysqli_close($conexao);
    ?>
</body>
</html>
