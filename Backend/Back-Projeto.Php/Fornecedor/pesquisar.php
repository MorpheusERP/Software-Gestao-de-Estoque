<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar as Compras</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Pesquisar Produtos Cadastrados</h1>
    <form action="" method="post">
        <label for="razao_social">Razão Social do Fornecedor:</label>
        <input type="text" name="razao_social" id="razao_social" required>
        <br>
        <label for="nome_fornecedor">Nome Fantasia:</label>
        <input type="text" name="nome_fornecedor" id="nome_fornecedor" required>
        <br>
        <label for="apelido">Apelido:</label>
        <input type="text" name="apelido" id="apelido" required>
        <br>
        <label for="grupo">Grupo:</label>
        <input type="text" name="grupo" id="grupo" required>
        <br>
        <input type="submit" value="Pesquisar">
    </form>
    <br>

    <?php
    include('conexao.php');

    // Se todos os campos forem preenchidos, realiza a pesquisa
    if (!empty($_POST['razao_social']) && !empty($_POST['nome_fornecedor']) && !empty($_POST['apelido']) && !empty($_POST['grupo'])) {
        $razao_social = "%" . $_POST['razao_social'] . "%";
        $nome_fornecedor = "%" . $_POST['nome_fornecedor'] . "%";
        $apelido = "%" . $_POST['apelido'] . "%";
        $grupo = "%" . $_POST['grupo'] . "%";

        $stmt = $conexao->prepare("SELECT razao_Social, apelido, grupo FROM fornecedor WHERE razao_Social LIKE ? AND nome_Fornecedor LIKE ? AND apelido LIKE ? AND grupo LIKE ?");
        $stmt->bind_param("ssss", $razao_social, $nome_fornecedor, $apelido, $grupo);

        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            echo "<h2>Informações do Fornecedor</h2>";
            echo "<table class='table'><thead><tr>
                    <th>Razão Social</th>
                    <th>Apelido</th>
                    <th>Grupo</th>
                  </tr></thead><tbody>";
            
            while ($row = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['razao_Social']) . "</td>
                        <td>" . htmlspecialchars($row['apelido']) . "</td>
                        <td>" . htmlspecialchars($row['grupo']) . "</td>
                      </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<h3>Nenhum resultado encontrado.</h3>";
        }
    } else {
        echo "<h3>Por favor, preencha todos os campos para realizar a pesquisa.</h3>";
    }

    // Fechando a conexão com o banco de dados
    mysqli_close($conexao);
    ?>
</body>
</html>
