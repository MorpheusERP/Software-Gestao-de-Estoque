<?php
 if (!isset($_SESSION)){  // Correção de "issert" para "isset"
    session_start();
 }

 if (!isset($_SESSION['nivel'])){
    die ("Você não pode aseecar esta pagina porque não esta logado.<p><a> herf=\"cadas.php\">Entrar<a><\p>");
 }

?>