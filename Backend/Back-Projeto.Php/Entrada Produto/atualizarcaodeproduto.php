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
    include ("conexao.php");

    $sql = "SELECT id_Entrada, id_Usuario, nome_Usuario, id_Fornecedor, nome_Fornecedor, cod_Produto, nome_Produto, id_Estoque, qtd_Entrada, preco_Custo, sub_Grupo, valor_Total, data_Entrada FROM entrada_produtos";

    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado)){
          echo "<table class='table'>
                <thead>
                  <tr>
                    <th>ID Entrada</th>
                    <th>ID Usuário</th>
                    <th>Nome Usuário</th>
                    <th>ID Fornecedor</th>
                    <th>Nome Fornecedor</th>
                    <th>Código Produto</th>
                    <th>Nome Produto</th>
                    <th>ID Estoque</th>
                    <th>Quantidade Entrada</th>
                    <th>Preço de Custo</th>
                    <th>Sub Grupo</th>
                    <th>Valor Total</th>
                    <th>Data Entrada</th>
                  </tr>
                </thead>
                <tbody>";
        
          // Exibe cada linha da tabela
          while ($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>
                    <td>".$row['id_Entrada']."</td>
                    <td>".$row['id_Usuario']."</td>
                    <td>".$row['nome_Usuario']."</td>
                    <td>".$row['id_Fornecedor']."</td>
                    <td>".$row['nome_Fornecedor']."</td>
                    <td>".$row['cod_Produto']."</td>
                    <td>".$row['nome_Produto']."</td>
                    <td>".$row['id_Estoque']."</td>
                    <td>".$row['qtd_Entrada']."</td>
                    <td>".$row['preco_Custo']."</td>
                    <td>".$row['sub_Grupo']."</td>
                    <td>".$row['valor_Total']."</td>
                    <td>".$row['data_Entrada']."</td>
                  </tr>";
          }

          echo "</tbody></table>";
    }
    else{
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
?>
    <br>

    <h2>Atualizar Estoque</h2>
<form action="atualizar.php" method="POST" class="center-form">
    <label for="NOVOid_Entrada">ID do produto a ser atualizado:</label>
    <input type="number" name="NOVOid_Entrada" id="NOVOid_Entrada"  class="form-control" required>
    <br>
    
    <label for="NOVOid_Usuario">ID do Usuário:</label>
    <input type="number" name="NOVOid_Usuario" id="NOVOid_Usuario"  class="form-control" required>
    <br>
    
    <label for="NOVOnome_Usuario">Nome do Usuário:</label>
    <input type="text" name="NOVOnome_Usuario" id="NOVOnome_Usuario"  class="form-control" required>
    <br>
    
    <label for="NOVOid_Fornecedor">ID do Fornecedor:</label>
    <input type="number" name="NOVOid_Fornecedor" id="NOVOid_Fornecedor"  class="form-control" required>
    <br>
    
    <label for="NOVOnome_Fornecedor">Nome do Fornecedor:</label>
    <input type="text" name="NOVOnome_Fornecedor" id="NOVOnome_Fornecedor"  class="form-control" required>
    <br>
    
    <label for="NOVOcod_Produto">Código do Produto:</label>
    <input type="text" name="NOVOcod_Produto" id="NOVOcod_Produto"  class="form-control" required>
    <br>
    
    <label for="NOVOnome_Produto">Nome do Produto:</label>
    <input type="text" name="NOVOnome_Produto" id="NOVOnome_Produto"  class="form-control" required>
    <br>
    
    <label for="NOVOid_Estoque">ID do Estoque:</label>
    <input type="number" name="NOVOid_Estoque" id="NOVOid_Estoque"  class="form-control" required>
    <br>
    
    <label for="NOVOqtd_Entrada">Quantidade de Entrada:</label>
    <input type="number" name="NOVOqtd_Entrada" id="NOVOqtd_Entrada" step="0.01" class="form-control" required>
    <br>
    
    <label for="NOVOpreco_Custo">Preço de Custo:</label>
    <input type="number" name="NOVOpreco_Custo" id="NOVOpreco_Custo" step="0.01"  class="form-control" required>
    <br>
    
    <label for="NOVOsub_Grupo">Subgrupo:</label>
    <input type="text" name="NOVOsub_Grupo" id="NOVOsub_Grupo"  class="form-control" required>
    <br>
    
    <label for="NOVOvalor_Total">Valor Total:</label>
    <input type="number" name="NOVOvalor_Total" id="NOVOvalor_Total" step="0.01"  class="form-control" required>
    <br>
    
    <label for="NOVOdata_Entrada">Data de Entrada:</label>
    <input type="date" name="NOVOdata_Entrada" id="NOVOdata_Entrada"  class="form-control" required>
    <br>
    
    <button type="submit"  class="btn btn-primary">Atualizar</button>
</form>

</body>
</html>