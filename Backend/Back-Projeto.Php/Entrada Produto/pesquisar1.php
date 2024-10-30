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
        <label for="fornecedor">Fornecedor:</label>
        <input type="text" name="fornecedor" id="fornecedor">
        
        <label for="produto">Produto:</label>
        <input type="text" name="produto" id="produto">

        <label for="grupo">Grupo:</label>
        <input type="text" name="grupo" id="grupo">

        <label for="subGrupo">Subgrupo:</label>
        <input type="text" name="subGrupo" id="subGrupo">

        <input type="submit" value="Pesquisar">
    </form>

    <br>
    <?php
    include('conexao.php');

    // Inicializa as variáveis de busca
    $fornecedor = isset($_POST['fornecedor']) ? $_POST['fornecedor'] : '';
    $produto = isset($_POST['produto']) ? $_POST['produto'] : '';
    $grupo = isset($_POST['grupo']) ? $_POST['grupo'] : '';
    $subGrupo = isset($_POST['subGrupo']) ? $_POST['subGrupo'] : '';

    // Prepara a consulta com base nos campos fornecidos
    $sql = "SELECT cod_Produto, data_Entrada, valor_Total FROM entrada_produtos WHERE 1=1";
    
    // Adiciona as condições de busca se os campos não estiverem vazios
    if (!empty($fornecedor)) {
        $sql .= " AND nome_Fornecedor LIKE '%$fornecedor%'";
    }
    if (!empty($produto)) {
        $sql .= " AND nome_Produto LIKE '%$produto%'";
    }
    if (!empty($grupo)) {
        $sql .= " AND grupo LIKE '%$grupo%'";  // Supondo que a coluna se chama 'grupo'
    }
    if (!empty($subGrupo)) {
        $sql .= " AND sub_Grupo LIKE '%$subGrupo%'";
    }

    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><thead><tr>
            <th>Código</th>
            <th>Período</th>
            <th>Valor</th>
        </tr></thead><tbody>";

        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr>
                <td>".$row['cod_Produto']."</td>
                <td>".$row['data_Entrada']."</td>
                <td>".$row['valor_Total']."</td>
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
