<?php
session_start();
include 'funcoes.php';

// Verifica se o usuário está logado e se é um administrador.
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <nav class="menu-navegacao">
        <div class="conteudo">
            <a href="index.php" class="titulo-menu">Gerenciador de Tarefas</a>
            <div>
                <a href="admin.php" class="link-menu">Painel Admin</a>
                <a href="logout.php" class="botao-logout">Sair</a>
            </div>
        </div>
    </nav>
    <div class="conteudo">
        <h1>Painel do Administrador</h1>
        <div class="admin-menu">
            <a href="admin_usuarios.php" class="botao-admin">Gerenciar Usuários</a>
            <a href="admin_clientes.php" class="botao-admin">Gerenciar Clientes</a>
        </div>
    </div>
</body>
</html>