<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Estoque</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo1.css">
</head>
<body>
    <h1>Atualizar dados no Estoque</h1>

    <?php
    include("conexao.php");

    $sql = "SELECT razao, fantasia, apelido, grupo FROM fornecedor";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><thead><tr><th>Razão Social</th><th>Nome Fantasia</th><th>Apelido</th><th>Grupo</th></tr></thead><tbody>";
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr><td>".$row['razao']."</td>
            <td>".$row['fantasia']."</td>
            <td>".$row['apelido']."</td>
            <td>".$row['grupo']."</td></tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
    ?>
    <br>

    <h2>Atualizar Estoque</h2>
    <form action="atualizar.php" method="POST" class="center-form">
        <label for="NOVOrazao">Razão Social</label>
        <input type="text" name="NOVOrazao" id="NOVOrazao" >
        <br>
        <label for="NOVOfantasia">Nome Fantasia: </label>
        <input type="text" name="NOVOfantasia" id="NOVOfantasia" >
        <br>
        <label for="NOVOapelido">Apelido: </label>
        <input type="text" name="NOVOapelido" id="NOVOapelido" >
        <br>
        <label for="NOVOgrupo">Grupo: </label>
        <input type="text" name="NOVOgrupo" id="NOVOgrupo" >
        <br>
        <button>Salvar</button>
    </form>
</body>
</html>

