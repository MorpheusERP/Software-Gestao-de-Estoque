<?php
 if (!isset($_SESSION)){  // Correção de "issert" para "isset"
    session_start();
 }
?>

<!DOCTYPE html>
<html lang="pt-br"> <!-- Alterei o idioma para português (pt-br) devido ao conteúdo em português -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bem vindo ao Painel</h1>
    <h2> <?php echo isset($_SESSION['nome']) ? $_SESSION['nome'] : 'Visitante'; ?> </h2> <!-- Adicionei uma verificação para evitar erros caso 'nome' não esteja definido na sessão -->

    <p>
        <a herf="logout.php"></a>
    </p>

</body>
</html>