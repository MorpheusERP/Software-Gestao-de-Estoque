<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Fornecedor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
<?php
    include('conexao.php');

    // Captura os dados do formulário
    $id_Fornecedor = mysqli_real_escape_string($conexao, $_POST['id_Fornecedor']);
    $razao_Social = mysqli_real_escape_string($conexao, $_POST['NOVOrazao_Social']);
    $nome_Fornecedor = mysqli_real_escape_string($conexao, $_POST['NOVOnome_Fornecedor']);
    $apelido = mysqli_real_escape_string($conexao, $_POST['NOVOapelido']);
    $grupo = mysqli_real_escape_string($conexao, $_POST['NOVOgrupo']);
    $sub_Grupo = mysqli_real_escape_string($conexao, $_POST['NOVOsub_Grupo']);
    $observacao = mysqli_real_escape_string($conexao, $_POST['NOVOobservacao']);

    // Atualiza os dados do fornecedor com base no ID
    $stmt = $conexao->prepare("UPDATE fornecedor SET razao_Social = ?, nome_Fornecedor = ?, apelido = ?, grupo = ?, sub_Grupo = ?, observacao = ? WHERE id_Fornecedor = ?");
    $stmt->bind_param("sssssss", $razao_Social, $nome_Fornecedor, $apelido, $grupo, $sub_Grupo, $observacao, $id_Fornecedor);

    if ($stmt->execute()) {
        echo "Dados atualizados no estoque.<br><br>";
    } else {
        echo "Erro na atualização do estoque: " . $stmt->error;
    }

    $stmt->close();

    // Exibe todos os fornecedores
    $sql = "SELECT id_Fornecedor, razao_Social, nome_Fornecedor, apelido, grupo, sub_Grupo, observacao FROM fornecedor";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table class='table'>
                <thead>
                    <tr>
                        <th>ID Fornecedor</th>
                        <th>Razão Social</th>
                        <th>Nome Fornecedor</th>
                        <th>Apelido</th>
                        <th>Grupo</th>
                        <th>Subgrupo</th>
                        <th>Observação</th>
                    </tr>
                </thead>
                <tbody>";
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr>
                    <td>".$row['id_Fornecedor']."</td>
                    <td>".$row['razao_Social']."</td>
                    <td>".$row['nome_Fornecedor']."</td>
                    <td>".$row['apelido']."</td>
                    <td>".$row['grupo']."</td>
                    <td>".$row['sub_Grupo']."</td>
                    <td>".$row['observacao']."</td>
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
