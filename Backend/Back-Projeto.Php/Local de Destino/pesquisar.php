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
        <label for="pesquisar_nome">Nome do Local:</label>
        <input type="text" name="pesquisar_nome" id="pesquisar_nome">
        
        <label for="pesquisar_tipo">Tipo de Local:</label>
        <input type="text" name="pesquisar_tipo" id="pesquisar_tipo">
        
        <input type="submit" value="Pesquisar">
    </form>

    <?php
    include('conexao.php');

    // Verifica se os campos de pesquisa foram enviados
    if ((isset($_POST['pesquisar_nome']) && !empty($_POST['pesquisar_nome'])) || 
        (isset($_POST['pesquisar_tipo']) && !empty($_POST['pesquisar_tipo']))) {
        
        $pesquisar_nome = isset($_POST['pesquisar_nome']) ? "%".$_POST['pesquisar_nome']."%" : "%";
        $pesquisar_tipo = isset($_POST['pesquisar_tipo']) ? "%".$_POST['pesquisar_tipo']."%" : "%";

        // Atualiza a consulta para pesquisar com base nos dois campos
        $stmt = $conexao->prepare("SELECT nome_Local, tipo_Local FROM local_destino WHERE nome_Local LIKE ? AND tipo_Local LIKE ?");
        $stmt->bind_param("ss", $pesquisar_nome, $pesquisar_tipo);

        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            echo "<h2>Resultados da Pesquisa:</h2>";
            echo "<table class='table'><thead><tr><th>Nome do Local</th><th>Tipo de Local</th></tr></thead><tbody>";
            
            while ($row = $resultado->fetch_assoc()) {
                echo "<tr><td>".$row['nome_Local']."</td>
                <td>".$row['tipo_Local']."</td></tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "Zero Resultados na pesquisa.";
        }

        $stmt->close();
    } else {
        // Consulta para exibir todos os dados se não houver pesquisa
        $sql = "SELECT nome_Local, tipo_Local FROM local_destino";
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            echo "<h2>Tabela de Locais Cadastrados:</h2>";
            echo "<table class='table'><thead><tr><th>Nome do Local</th><th>Tipo de Local</th></tr></thead><tbody>";
            
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr><td>".$row['nome_Local']."</td>
                <td>".$row['tipo_Local']."</td></tr>";
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
