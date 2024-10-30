<?php

if (!isset($_SESSION)) {  
    session_start();
}

if (!isset($_SESSION['nivel'])) {  
    die("Você não pode acessar essa página porque não está logado. <p><a href=\"cadas.php\">Entrar</a></p>"); 
}
?>