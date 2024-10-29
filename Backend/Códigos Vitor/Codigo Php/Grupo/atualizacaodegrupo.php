<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Grupo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo1.css">
</head>
<body>
    <h1>Atualização da Tabela</h1>

    <?php
    include("conexao.php");

    $sql = "SELECT ID, nome, tipo FROM grupo";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><thead><tr><th>ID</th><th>Nome</th><th>Tipo de Local</th></tr></thead><tbody>";
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr><td>".$row['ID']."</td>
            <td>".$row['nome']."</td>
            <td>".$row['tipo']."</td></tr>";
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
        <label for="NOVOID">Novo ID:</label>
        <input type="number" name="NOVOID" id="NOVOID">
        <br>
        <label for="NOVOnome">Novo Nome:</label>
        <input type="text" name="NOVOnome" id="NOVOnome">
        <br>
        <label for="NOVOtipo">Novo Tipo de Local:</label>
        <input type="text" name="NOVOtipo" id="NOVOtipo">
        <br>
        <button> Atualizar Dados </button>
    </form>
</body>
</html>
