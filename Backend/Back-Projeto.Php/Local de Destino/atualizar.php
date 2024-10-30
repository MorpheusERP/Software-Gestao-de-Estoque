<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização de Local</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

<?php
    include('conexao.php');

    // Captura os dados do formulário
    $NOVOid_Local = mysqli_real_escape_string($conexao, $_POST['NOVOid_Local']); // ID Local
    $NOVOnome_Local = mysqli_real_escape_string($conexao, $_POST['NOVOnome_Local']); // Nome
    $NOVOtipo_Local = mysqli_real_escape_string($conexao, $_POST['NOVOtipo_Local']); // Tipo
    $NOVOobservacao = mysqli_real_escape_string($conexao, $_POST['NOVOobservacao']); // Observação

    // Atualizando os dados na tabela
    $stmt = $conexao->prepare("UPDATE local_destino SET id_Local = ?, nome_Local = ?, tipo_Local = ?, observacao = ? WHERE id_Local = ?"); // Incluindo observação
    $stmt->bind_param("ssssi", $NOVOid_Local, $NOVOnome_Local, $NOVOtipo_Local, $NOVOobservacao, $NOVOid_Local); // Atualização da ligação

    if ($stmt->execute()) {
        echo "Dados atualizados no estoque.<br><br>";
    } else {
        echo "Erro na atualização do estoque: " . $stmt->error;
    }

    $stmt->close();

    // Consultando os dados atualizados
    $sql = "SELECT id_Local, nome_Local, tipo_Local, observacao FROM local_destino"; // Mudança para incluir observação
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'><thead><tr><th>ID Local</th><th>Nome</th><th>Tipo de Local</th><th>Observação</th></tr></thead><tbody>";
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr><td>".$row['id_Local']."</td><td>".$row['nome_Local']."</td><td>".$row['tipo_Local']."</td><td>".$row['observacao']."</td></tr>"; // Adicionando observação
        }

        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
?>
</body>
</html>
