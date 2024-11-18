<?php
// Inclui a conexão com o banco de dados
include('conexao.php');

// Inicia a sessão
session_start(); // Certifique-se de iniciar a sessão no início

// Verifica se os dados foram enviados via POST
if (isset($_POST['logi']) && isset($_POST['senha'])) {

    // Verifica se o campo login está vazio
    if (strlen(trim($_POST['logi'])) == 0) {
        echo "Preencha seu Login";
    }
    // Verifica se o campo senha está vazio
    else if (strlen(trim($_POST['senha'])) == 0) {
        echo "Preencha sua Senha";
    } 
    // Caso ambos os campos estejam preenchidos
    else {
        // Protege contra SQL Injection usando prepared statements
        $logi = trim($_POST['logi']);
        $senha = trim($_POST['senha']); // Captura a senha diretamente

        // Consulta SQL para buscar o usuário no banco de dados
        $sql_code = "SELECT * FROM usuario WHERE logi = ? AND senha = ?";
        $stmt = mysqli_prepare($conexao, $sql_code);
        
        // Verifica se a preparação da consulta foi bem-sucedida
        if (!$stmt) {
            die("Erro ao preparar a consulta: " . mysqli_error($conexao));
        }

        mysqli_stmt_bind_param($stmt, 'ss', $logi, $senha); // Vincula o login e a senha ao parâmetro
        mysqli_stmt_execute($stmt);
        $sql_query = mysqli_stmt_get_result($stmt);

        if (!$sql_query) {
            die("Falha na execução da consulta: " . mysqli_error($conexao));
        }

        $quantidade = mysqli_num_rows($sql_query);

        if ($quantidade == 1) {
            $usuario = mysqli_fetch_assoc($sql_query);

            // Armazena as informações do usuário na sessão
            $_SESSION['nivel'] = $usuario['nivel'];
            $_SESSION['nome'] = $usuario['nome'];
            
            // Redireciona para o painel
            header("Location: painel.php");
            exit(); // Adicione exit() após o redirecionamento para evitar execução adicional
        } else {
            echo "Falha ao logar, usuário ou senha incorretos."; // Mensagem genérica
        }
    }
}
?>
