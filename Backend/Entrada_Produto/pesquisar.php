<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Entrada de Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <div class="container mt-4">
        <!-- Formulário de Pesquisa -->
        <form method="GET" action="" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="pesquisar" 
                       value="<?php echo isset($_GET['pesquisar']) ? htmlspecialchars($_GET['pesquisar']) : ''; ?>" 
                       placeholder="Digite para pesquisar...">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                </div>
            </div>
        </form>

        <?php
        include('conexao.php');

        // Exibe mensagens de erro/sucesso
        session_start();
        if(isset($_SESSION['mensagem'])) {
            echo '<div class="alert alert-success">' . $_SESSION['mensagem'] . '</div>';
            unset($_SESSION['mensagem']);
        }
        if(isset($_SESSION['erro'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['erro'] . '</div>';
            unset($_SESSION['erro']);
        }

        try {
            // Query base
            $sql = "SELECT e.* FROM entrada_produtos e";
            $params = [];
            $types = "";

            // Adiciona condição de pesquisa se houver
            if(isset($_GET['pesquisar']) && !empty($_GET['pesquisar'])) {
                $sql .= " WHERE e.nome_Produto LIKE ? OR e.nome_Usuario LIKE ?";
                $searchTerm = "%" . $_GET['pesquisar'] . "%";
                $params = [$searchTerm, $searchTerm];
                $types = "ss";
            }

            $stmt = $conexao->prepare($sql);
            
            if (!empty($params)) {
                $stmt->bind_param($types, ...$params);
            }
            
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Data</th>
                                <th>Usuário</th>
                                <th>Fornecedor</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Preço Custo</th>
                                <th>Valor Total</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id_Entrada']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['data_Entrada'])); ?></td>
                                    <td><?php echo $row['nome_Usuario']; ?></td>
                                    <td><?php echo $row['id_Fornecedor']; ?></td>
                                    <td><?php echo $row['nome_Produto']; ?></td>
                                    <td><?php echo number_format($row['qtd_Entrada'], 2, ',', '.'); ?></td>
                                    <td>R$ <?php echo number_format($row['preco_Custo'], 2, ',', '.'); ?></td>
                                    <td>R$ <?php echo number_format($row['valor_Total'], 2, ',', '.'); ?></td>
                                    <td>
                                        <a href="editar.php?id=<?php echo $row['id_Entrada']; ?>" 
                                           class="btn btn-sm btn-warning">Editar</a>
                                        <a href="deletar.php?id=<?php echo $row['id_Entrada']; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <?php
            } else {
                echo '<div class="alert alert-info">Nenhum registro encontrado.</div>';
            }
        } catch (Exception $e) {
            echo '<div class="alert alert-danger">Erro ao buscar registros: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
        ?>

        <!-- Botão para adicionar nova entrada -->
        <a href="cadastro.php" class="btn btn-success mt-3">Nova Entrada</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>