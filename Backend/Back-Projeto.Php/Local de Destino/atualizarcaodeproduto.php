<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Local</title> <!-- Título atualizado -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Atualização da Tabela</h1>

    <?php
    include("conexao.php");

    $sql = "SELECT id_Local, nome_Local, tipo_Local, observacao FROM local_destino"; // Mudança de tabela e colunas
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><thead><tr><th>ID Local</th><th>Nome</th><th>Tipo de Local</th><th>Observação</th></tr></thead><tbody>";
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr><td>".$row['id_Local']."</td> <!-- Mudança de coluna -->
            <td>".$row['nome_Local']."</td> <!-- Mudança de coluna -->
            <td>".$row['tipo_Local']."</td> <!-- Mudança de coluna -->
            <td>".$row['observacao']."</td></tr>"; // Mudança de coluna
        }
        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
    ?>

    <br>

    <h2>Atualizar Local</h2> <!-- Título atualizado -->
    <form action="atualizar.php" method="POST" class="center-form">
        <label for="NOVOid_Local">Novo ID Local:</label> <!-- Mudança de rótulo -->
        <input type="number" name="NOVOid_Local" id="NOVOid_Local">
        <br>
        <label for="NOVOnome_Local">Novo Nome:</label>
        <input type="text" name="NOVOnome_Local" id="NOVOnome_Local">
        <br>
        <label for="NOVOtipo_Local">Novo Tipo de Local:</label>
        <input type="text" name="NOVOtipo_Local" id="NOVOtipo_Local">
        <br>
        <label for="NOVOobservacao">Nova Observação:</label> <!-- Novo campo de observação -->
        <input type="text" name="NOVOobservacao" id="NOVOobservacao">
        <br>
        <button> Atualizar Dados </button>
    </form>
</body>
</html>
