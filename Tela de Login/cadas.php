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
        $senha = trim($_POST['senha']); // Não precisa escapar a senha

        // Consulta SQL para buscar o usuário no banco de dados
        $sql_code = "SELECT * FROM usuario WHERE logi = ?";
        $stmt = mysqli_prepare($conexao, $sql_code);
        
        // Verifica se a preparação da consulta foi bem-sucedida
        if (!$stmt) {
            die("Erro ao preparar a consulta: " . mysqli_error($conexao));
        }

        mysqli_stmt_bind_param($stmt, 's', $logi); // Vincula o login ao parâmetro
        mysqli_stmt_execute($stmt);
        $sql_query = mysqli_stmt_get_result($stmt);

        if (!$sql_query) {
            die("Falha na execução da consulta: " . mysqli_error($conexao));
        }

        $quantidade = mysqli_num_rows($sql_query);

        if ($quantidade == 1) {
            $usuario = mysqli_fetch_assoc($sql_query);

            // Debug: Exibir a senha armazenada e a senha inserida
            echo "Senha Armazenada: " . $usuario['senha'] . "<br>";
            echo "Senha Inserida: " . $senha . "<br>";

            // Verifica se a senha fornecida corresponde ao que está armazenado
            if (password_verify($senha, $usuario['senha'])) { // Use password_verify
                // Armazena as informações do usuário na sessão
                $_SESSION['nivel'] = $usuario['nivel'];
                $_SESSION['nome'] = $usuario['nome'];
                
                // Redireciona para o painel
                header("Location: painel.php");
                exit(); // Adicione exit() após o redirecionamento para evitar execução adicional
            } else {
                echo "Falha ao logar, usuário ou senha incorretos."; // Mensagem genérica
            }
        } else {
            echo "Falha ao logar, usuário ou senha incorretos."; // Mensagem genérica
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="verificar.php" method="POST">
        <label for="logi">Login:</label>
        <input type="text" id="logi" name="logi" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>

