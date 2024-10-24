<!-- Conexão pelo pgAdmin 4 -->

<?php
$host = "localhost"; // ou o IP do servidor PostgreSQL
$port = "5432"; // Porta padrão do PostgreSQL
$dbname = "estoque"; // Nome do banco de dados que você criou no pgAdmin
$user = "postgres"; // Seu usuário PostgreSQL
$password = "12345"; // Sua senha do PostgreSQL
 
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Conexão com PostgreSQL falhou: " . pg_last_error());
}
?>

