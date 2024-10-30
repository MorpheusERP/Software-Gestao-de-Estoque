<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Estoque</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Atualizar dados no Estoque</h1>

    <?php
    include("conexao.php");

    // Seleciona as informações atuais do fornecedor
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
    <br>

    <h2>Atualizar Estoque</h2>
<form action="atualizar.php" method="POST" class="center-form">
    <label for="id_Fornecedor">ID Fornecedor:</label>
    <input type="text" name="id_Fornecedor" id="id_Fornecedor" class="form-control" required>
    <br>
    <label for="NOVOrazao_Social">Nova Razão Social</label>
    <input type="text" name="NOVOrazao_Social" id="NOVOrazao_Social" class="form-control">
    <br>
    <label for="NOVOnome_Fornecedor">Novo Nome do Fornecedor:</label>
    <input type="text" name="NOVOnome_Fornecedor" id="NOVOnome_Fornecedor" class="form-control">
    <br>
    <label for="NOVOapelido">Novo Apelido: </label>
    <input type="text" name="NOVOapelido" id="NOVOapelido" class="form-control">
    <br>
    <label for="NOVOgrupo">Novo Grupo: </label>
    <input type="text" name="NOVOgrupo" id="NOVOgrupo" class="form-control">
    <br>
    <label for="NOVOsub_Grupo">Novo Subgrupo: </label>
    <input type="text" name="NOVOsub_Grupo" id="NOVOsub_Grupo" class="form-control">
    <br>
    <label for="NOVOobservacao">Nova Observação: </label>
    <input type="text" name="NOVOobservacao" id="NOVOobservacao" class="form-control">
    <br>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>


