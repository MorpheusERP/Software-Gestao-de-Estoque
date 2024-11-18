<?php
session_start();

include '../conexao.php'; // Conexão com o banco de dados

// Recebe os dados enviados pelo JavaScript
$data = json_decode(file_get_contents('php://input'), true);
$nome_Produto = $data['nome_Produto'] ?? null;
$nome_Local = $data['nome_Local'] ?? null;
$grupo = $data['grupo'] ?? null;
$sub_Grupo = $data['sub_Grupo'] ?? null;
$start_date = $data['start_date'] ?? null;
$end_date = $data['end_date'] ?? null;

// Validação adicional para garantir que as datas estejam no formato correto
if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $start_date) || preg_match("/^\d{4}-\d{2}-\d{2}$/", $end_date)) {

    // Array para armazenar condições dinâmicas
    $condicoes = [];
    $params = [];

    // Condições da consulta baseadas nos parâmetros fornecidos
    if (!empty($nome_Produto)) {
        $condicoes[] = "nome_Produto LIKE ?";
        $params[] = '%' . $nome_Produto . '%';
    }
    if (!empty($nome_Local)) {
        $condicoes[] = "nome_Local LIKE ?";
        $params[] = '%' . $nome_Local . '%';
    }
    if (!empty($grupo)) {
        $condicoes[] = "grupo = ?";
        $params[] = $grupo;
    }
    if (!empty($sub_Grupo)) {
        $condicoes[] = "sub_Grupo = ?";
        $params[] = $sub_Grupo;
    }

    $idLote = []; // Array para armazenar os id_Lote encontrados

    // Se algum filtro foi enviado (produto, fornecedor, grupo ou subgrupo)
    if (!empty($condicoes)) {
        // Construir consulta para a tabela saida_produtos com os filtros aplicados
        $sqlProdutos = "SELECT id_Lote FROM saida_produtos WHERE " . implode(" AND ", $condicoes);
        $stmtProdutos = $mysqli->prepare($sqlProdutos);

        if ($stmtProdutos) {
            // Associa os parâmetros aos placeholders, se existirem
            if (!empty($params)) {
                $tipos = str_repeat("s", count($params));
                $stmtProdutos->bind_param($tipos, ...$params);
            }
            
            $stmtProdutos->execute();
            $resultProdutos = $stmtProdutos->get_result();

            // Armazena os id_Entrada encontrados
            while ($row = $resultProdutos->fetch_assoc()) {
                $idLote[] = $row['id_Lote'];
            }

            $stmtProdutos->close();
        } else {
            echo json_encode(['status' => 'erro', 'mensagem' => 'Erro na consulta parcial de produtos.']);
            exit();
        }
    }

    if (!empty($start_date) && !empty($end_date)) {
        // Cria placeholders para a cláusula IN se houver IDs de lotes a filtrar
        $placeholders = !empty($idLote) ? implode(',', array_fill(0, count($idLote), '?')) : '';

        // Monta a consulta SQL para a view saidas_por_data com data e filtro opcional de IDs
        $sqlLote = "SELECT id_Lote, data_Saida, valor_Lote FROM saidas_por_data WHERE data_Saida BETWEEN ? AND ?";
        if (!empty($idLote)) {
            $sqlLote .= " AND id_Lote IN ($placeholders)";
        }

        // Prepara e executa a consulta
        $stmtLote = $mysqli->prepare($sqlLote);
        $types = 'ss' . str_repeat('i', count($idLote));
        $paramsLote = array_merge([$start_date, $end_date], $idLote);
        $stmtLote->bind_param($types, ...$paramsLote);
        $stmtLote->execute();
        $resultLote = $stmtLote->get_result();

        // Processa os resultados da consulta e formata a saída
        $saidas = [];
        while ($row = $resultLote->fetch_assoc()) {
            // Formata a data para dia/mês/ano
            $dataEntrada = new DateTime($row['data_Saida']);
            $row['data_Saida'] = $dataEntrada->format('d/m/Y');
            
            // Formata o valor_Lote para incluir "R$" e duas casas decimais
            $row['valor_Lote'] = 'R$ ' . number_format($row['valor_Lote'], 2, ',', '.');
            
            $saidas[] = $row;
        }


        echo json_encode(['status' => 'sucesso', 'saidas' => $saidas]);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Nenhuma saida encontrada.']);
    }
}
else {
    echo json_encode(['status' => 'errodata', 'mensagem' => 'Informe o período para consulta.']);
}
$mysqli->close();
?>
