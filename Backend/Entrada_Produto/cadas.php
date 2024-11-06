<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Saída de Produto</title>
    <style>
        body {
            background-color: #4B0082; /* Roxo escuro */
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 40px;
        }

        form {
            width: 100%;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 1.1em;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            background: white;
            font-size: 1em;
            box-sizing: border-box;
        }

        button {
            background-color: #0096FF; /* Azul brilhante */
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1em;
            margin-top: 10px;
            width: auto;
            align-self: center;
        }

        button:hover {
            background-color: #0077CC;
        }

        .alert {
            width: 100%;
            max-width: 500px;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }

        .alert-success {
            background-color: #28a745;
            color: white;
        }

        .alert-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Cadastro de Entrada de Produto</h1>

    <?php
    session_start();
    if(isset($_SESSION['mensagem'])) {
        echo '<div class="alert alert-success">' . $_SESSION['mensagem'] . '</div>';
        unset($_SESSION['mensagem']);
    }
    if(isset($_SESSION['erro'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['erro'] . '</div>';
        unset($_SESSION['erro']);
    }
    ?>

    <form action="cadastro.php" method="POST">
        <div>
            <label for="id_Usuario">Id do Usuário:</label>
            <select name="id_Usuario" id="id_Usuario" required>
                <option value="">Selecione o usuário</option>
                <?php
                include("conexao.php");
                $query = "SELECT id_Usuario, nome_Usuario FROM usuario";
                $result = mysqli_query($conexao, $query);
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='".$row['id_Usuario']."'>".$row['id_Usuario']." - ".$row['nome_Usuario']."</option>";
                }
                ?>
            </select>
        </div>
        
        <div>
            <label for="cod_Produto">Código Produto:</label>
            <select name="cod_Produto" id="cod_Produto" required onchange="preencherNomeProduto(this.value)">
                <option value="">Selecione o produto</option>
                <?php
                $query = "SELECT cod_Produto, nome_Produto FROM produto";
                $result = mysqli_query($conexao, $query);
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='".$row['cod_Produto']."' data-nome='".$row['nome_Produto']."'>"
                         .$row['cod_Produto']." - ".$row['nome_Produto']."</option>";
                }
                ?>
            </select>
        </div>

        <div>
            <label for="nome_Produto">Nome Produto:</label>
            <input type="text" name="nome_Produto" id="nome_Produto" readonly required>
        </div>

        <div>
            <label for="id_Fornecedor">ID do Fornecedor:</label>
            <select name="id_Fornecedor" id="id_Fornecedor" required>
                <option value="">Selecione o fornecedor</option>
                <?php
                $query = "SELECT id_Fornecedor, razao_Social FROM fornecedor";
                $result = mysqli_query($conexao, $query);
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='".$row['id_Fornecedor']."'>"
                         .$row['id_Fornecedor']." - ".$row['razao_Social']."</option>";
                }
                mysqli_close($conexao);
                ?>
            </select>
        </div>

        <div>
            <label for="qtd_Entrada">Quantidade Entrada:</label>
            <input type="number" name="qtd_Entrada" id="qtd_Entrada" step="0.01" min="0" required>
        </div>

        <div>
            <label for="preco_Custo">Preço Custo:</label>
            <input type="number" name="preco_Custo" id="preco_Custo" step="0.01" min="0" required>
        </div>

        <div>
            <label for="preco_Venda">Preço Venda:</label>
            <input type="number" name="preco_Venda" id="preco_Venda" step="0.01" min="0" required>
        </div>

        <div>
            <label for="sub_Grupo">Sub Grupo:</label>
            <input type="text" name="sub_Grupo" id="sub_Grupo" required>
        </div>

        <button type="submit">Cadastrar</button>
    </form>

    <script>
        function preencherNomeProduto(codProduto) {
            const select = document.getElementById('cod_Produto');
            const option = select.options[select.selectedIndex];
            const nomeProduto = option.getAttribute('data-nome');
            document.getElementById('nome_Produto').value = nomeProduto || '';
    }
</script>
</body>
</html>