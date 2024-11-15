<?php
//Este arquivo encerra a sessão do usuario logado no sistema

session_start();
session_unset(); // Remove todas as variáveis de sessão
session_destroy(); // Destroi a sessão

echo json_encode(['status' => 'success']);
?>
