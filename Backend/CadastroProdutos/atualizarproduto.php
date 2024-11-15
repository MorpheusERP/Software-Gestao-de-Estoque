<?php

//Este arquivo serve para atualizar o produto com o cod_Produto fornecido pelo arquivo alterarProduto.html

include '../conexao.php';

header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Verifique a conexão com o banco de dados
    if ($mysqli->connect_error) {
        throw new Exception("Falha na conexão com o banco de dados: " . $mysqli->connect_error);
    }

    $cod_Produto = $_POST['codigo'] ?? null;
    $nome_Produto = $_POST['nome'] ?? null;
    $tipo_Produto = $_POST['tipo'] ?? null;
    $cod_Barras = $_POST['codigoBarras'] ?? null;
    $preco_Custo = $_POST['precoCusto'] ?? null;
    $preco_Venda = $_POST['precoVenda'] ?? null;
    $grupo = $_POST['grupo'] ?? null;
    $sub_grupo = $_POST['subgrupo'] ?? null;
    $observacao = $_POST['observacoes'] ?? null;

    // Verifica se a imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        // Obter imagem antiga
        $stmt = $mysqli->prepare("SELECT imagem FROM produto WHERE cod_Produto = ?");
        if (!$stmt) throw new Exception("Erro ao preparar consulta: " . $mysqli->error);
        
        $stmt->bind_param("i", $cod_Produto);
        $stmt->execute();
        $stmt->bind_result($imagemAntiga);
        $stmt->fetch();
        $stmt->close();

        if ($imagemAntiga && file_exists($imagemAntiga)) {
            if (!unlink($imagemAntiga)) throw new Exception("Falha ao excluir imagem antiga.");
        }

        // Processa a nova imagem
        $imagem = $_FILES['imagem'];
        $imagemNome = $imagem['name'];
        $imagemTemp = $imagem['tmp_name'];
        $imagemDestino = "imagens/" . uniqid() . '_' . $imagemNome;
        
        if (!move_uploaded_file($imagemTemp, $imagemDestino)) {
            throw new Exception("Erro ao salvar imagem.");
        }

        // Atualiza produto com nova imagem
        $stmt = $mysqli->prepare("UPDATE produto SET imagem = ?, preco_Venda = ?, nome_Produto = ?, tipo_Produto = ?, cod_Barras = ?, preco_Custo = ?, grupo = ?, sub_Grupo = ?, observacao = ? WHERE cod_Produto = ?");
        
        if (!$stmt) throw new Exception("Erro ao preparar atualização: " . $mysqli->error);
        $stmt->bind_param("sdssidsssi", $imagemDestino, $preco_Venda, $nome_Produto, $tipo_Produto, $cod_Barras, $preco_Custo, $grupo, $sub_grupo, $observacao, $cod_Produto);

        if (!$stmt->execute()) throw new Exception("Erro na execução da atualização: " . $stmt->error);
        echo json_encode(["status" => "sucesso", "mensagem" => "Produto atualizado com sucesso."]);
    } else {
        // Atualiza dados sem imagem
        $stmt = $mysqli->prepare("UPDATE produto SET preco_Venda = ?, nome_Produto = ?, tipo_Produto = ?, cod_Barras = ?, preco_Custo = ?, grupo = ?, sub_Grupo = ?, observacao = ? WHERE cod_Produto = ?");
        
        if (!$stmt) throw new Exception("Erro ao preparar atualização: " . $mysqli->error);
        $stmt->bind_param("dssidsssi", $preco_Venda, $nome_Produto, $tipo_Produto, $cod_Barras, $preco_Custo, $grupo, $sub_grupo, $observacao, $cod_Produto);

        if (!$stmt->execute()) throw new Exception("Erro na execução da atualização: " . $stmt->error);
        echo json_encode(["status" => "sucesso", "mensagem" => "Produto atualizado com sucesso."]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "erro", "mensagem" => $e->getMessage()]);
}

if (isset($stmt)) $stmt->close();
$mysqli->close();
?>
