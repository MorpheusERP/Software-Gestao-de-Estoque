<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

<?php

   include('conexao.php'); 

   // Recebe os dados do formulário
   $id_saida = $_POST['NOVOid_saida'];
   $id_usuario = $_POST['NOVOid_usuario'];
   $nome_usuario = $_POST['NOVOnome_usuario'];
   $cod_produto = $_POST['NOVOcod_produto'];
   $nome_produto = $_POST['NOVOnome_produto'];
   $id_local = $_POST['NOVOid_local'];
   $preco_custo = $_POST['NOVOpreco_custo'];
   $nome_local = $_POST['NOVOnome_local'];
   $id_estoque = $_POST['NOVOid_estoque'];
   $qtd_saida = $_POST['NOVOqtd_saida'];
   $valor_total = $_POST['NOVOvalor_total'];
   $observacao = $_POST['NOVOobservacao'];
   $data_saida = $_POST['NOVOdata_saida'];

   // Atualiza os dados no banco de dados
   $stmt = $conexao->prepare("UPDATE saida SET id_usuario = ?, nome_usuario = ?, cod_produto = ?, nome_produto = ?, id_local = ?, preco_custo = ?, nome_local = ?, id_estoque = ?, qtd_saida = ?, valor_total = ?, observacao = ?, data_saida = ? WHERE id_saida = ?");
   $stmt->bind_param("issssdsisdssi", $id_usuario, $nome_usuario, $cod_produto, $nome_produto, $id_local, $preco_custo, $nome_local, $id_estoque, $qtd_saida, $valor_total, $observacao, $data_saida, $id_saida);

   if ($stmt->execute()) {
       echo "Dados atualizados no estoque.<br><br>";
   } else {
       echo "Erro na atualização do estoque: " . $stmt->error;
   }
   $stmt->close();


?>

</body>
</html>
