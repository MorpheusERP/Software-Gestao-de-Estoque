<?php
include("conexao.php");

// Recebe os dados do formulário
$cod_produto = $_POST['cod_produto'];
$nome_produto = $_POST['nome_produto'];
$nome_local = $_POST['nome_local'];
$qtd_saida = $_POST['qtd_saida'];
$observacao = $_POST['observacao'];

$imagem = null; // Variável para armazenar o nome do arquivo

// Verifica se o arquivo foi enviado
if (isset($_FILES['imagem'])) {
    $imagem = $_FILES['imagem'];

    if ($imagem['error'] != 0) {
        die("Falha ao enviar o arquivo");
    }

    if ($imagem['size'] > 2097152) {
        die("Arquivo muito grande! Max 2MB");
    }

    $pasta = "imagem/";
    $novoNomeArquivo = uniqid();
    $extensao = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));
    $caminhoArquivo = $pasta . $novoNomeArquivo . "." . $extensao;

    $deu_certo = move_uploaded_file($imagem["tmp_name"], $caminhoArquivo);

    if (!$deu_certo) {
        die("Falha ao mover o arquivo para o diretório");
    }

    echo "Arquivo enviado com sucesso!<br>";
}

// Verifica se o cod_produto já existe
$check_cod_sql = "SELECT cod_produto FROM saida_produtos WHERE cod_produto = ?";
$stmt_check = mysqli_prepare($conexao, $check_cod_sql);
mysqli_stmt_bind_param($stmt_check, 'i', $cod_produto);
mysqli_stmt_execute($stmt_check);
mysqli_stmt_store_result($stmt_check);

if (mysqli_stmt_num_rows($stmt_check) > 0) {
    echo "Erro: Este código de produto já está cadastrado.";
} else {
    // Verifica se a quantidade de saída e o nome local foram preenchidos
    if ($qtd_saida === null || $qtd_saida <= 0) {
        echo "Erro: A quantidade de saída deve ser um número positivo.";
    } elseif (empty($nome_local)) {
        echo "Erro: O nome do local não pode ser vazio.";
    } elseif (empty($observacao)) {
        echo "Erro: A observação não pode ser vazia.";
    } else {
        // SQL para inserir os dados na tabela "saida_produtos"
        $sql = "INSERT INTO saida_produtos (cod_produto, imagem, nome_produto, nome_local, qtd_saida, observacao) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $sql);

        $caminhoArquivoEscapado = addslashes($caminhoArquivo);

        // Inclui o cod_produto como o primeiro parâmetro
        mysqli_stmt_bind_param($stmt, 'isssis', $cod_produto, $caminhoArquivoEscapado, $nome_produto, $nome_local, $qtd_saida, $observacao);

        if (mysqli_stmt_execute($stmt)) {
            echo "Saída registrada com sucesso!";
        } else {
            echo "Erro: " . mysqli_error($conexao);
        }
    }
}

// Fecha as consultas preparadas e a conexão
mysqli_stmt_close($stmt_check);
if (isset($stmt)) {
    mysqli_stmt_close($stmt);
}
mysqli_close($conexao);
?>
