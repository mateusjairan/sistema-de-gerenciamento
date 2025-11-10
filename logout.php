<?php
// Inicia a sessão para acessar os dados da sessão.
session_start();
// Destrói todos os dados da sessão.
session_destroy();
// Redireciona o usuário para a página de login.
header('Location: login.php');
exit;
?>