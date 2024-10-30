<?php
include("conexao.php");

// Recebe os dados do formulário
$cod_produto = $_POST['cod_produto'];
$nome_produto = $_POST['nome_produto'];
$tipo_produto = $_POST['tipo_produto'];
$cod_barras = $_POST['cod_barras'];
$preco_custo = $_POST['preco_custo'];
$preco_venda = $_POST['preco_venda'];
$grupo = $_POST['grupo'];
$sub_grupo = $_POST['sub_grupo'];
$observacao = $_POST['observacao'];

$imagem = null; // Variável para armazenar o nome do arquivo

// Verifica se o arquivo foi enviado
if (isset($_FILES['imagem'])) {
    $imagem = $_FILES['imagem'];

    // Verifica se houve algum erro no upload do arquivo
    if ($imagem['error'] != 0) {
        die("Falha ao enviar o arquivo");
    }

    // Verifica o tamanho do arquivo (máx. 2MB)
    if ($imagem['size'] > 2097152) {
        die("Arquivo muito grande! Max 2MB");
    }

    // Diretório para salvar os arquivos
    $pasta = "imagem/"; // Certifique-se de que essa pasta exista

    // Nome único para o arquivo
    $novoNomeArquivo = uniqid();

    // Extensão do arquivo
    $extensao = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));

    // Define o caminho completo para salvar o arquivo
    $caminhoArquivo = $pasta . $novoNomeArquivo . "." . $extensao;

    // Move o arquivo para o diretório de destino
    $deu_certo = move_uploaded_file($imagem["tmp_name"], $caminhoArquivo);

    if (!$deu_certo) {
        die("Falha ao mover o arquivo para o diretório");
    }

    echo "Arquivo enviado com sucesso!";
}



// Verifica se o código do produto já existe na tabela 'produto'
$check_produto_sql = "SELECT cod_produto FROM produto WHERE cod_produto = ?";
$stmt_produto = mysqli_prepare($conexao, $check_produto_sql);
mysqli_stmt_bind_param($stmt_produto, 's', $cod_produto);
mysqli_stmt_execute($stmt_produto);
mysqli_stmt_store_result($stmt_produto);

// Verifica se o código de barras já existe na tabela 'produto'
$check_barras_sql = "SELECT cod_barras FROM produto WHERE cod_barras = ?";
$stmt_barras = mysqli_prepare($conexao, $check_barras_sql);
mysqli_stmt_bind_param($stmt_barras, 's', $cod_barras);
mysqli_stmt_execute($stmt_barras);
mysqli_stmt_store_result($stmt_barras);

// Condições para verificação de duplicidade
if (mysqli_stmt_num_rows($stmt_produto) > 0) {
    echo "Erro: Este código de produto já está cadastrado.";
} elseif (mysqli_stmt_num_rows($stmt_barras) > 0) {
    echo "Erro: Este código de barras já está cadastrado.";
} else {
    // SQL para inserir os dados no banco, incluindo o arquivo (se houver)
    $sql = "INSERT INTO produto (cod_produto, imagem, nome_produto, tipo_produto, cod_barras, preco_custo, preco_venda, grupo, sub_grupo, observacao) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    // Atribui o caminho do arquivo escapado
    $caminhoArquivoEscapado = addslashes($caminhoArquivo);

    // Passa as variáveis para a função
    mysqli_stmt_bind_param($stmt, 'ssssddssss', $cod_produto, $caminhoArquivoEscapado, $nome_produto, $tipo_produto, $cod_barras, $preco_custo, $preco_venda, $grupo, $sub_grupo, $observacao);

    // Verifica se a inserção foi bem-sucedida
    if (mysqli_stmt_execute($stmt)) {
        echo "Produto cadastrado com sucesso";
    } else {
        echo "Erro: " . mysqli_error($conexao);
    }
}

// Fecha as consultas preparadas e a conexão
mysqli_stmt_close($stmt_produto);
mysqli_stmt_close($stmt_barras);
mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>