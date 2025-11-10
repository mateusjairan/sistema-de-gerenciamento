<?php
session_start();
include 'funcoes.php';

// Verifica se o usuário está logado e se é um administrador.
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Lógica para atualizar o usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
    atualizarUsuario($conexao, $_POST['id'], $_POST['nome'], $_POST['email'], $_POST['tipo']);
    header('Location: admin_usuarios.php');
    exit;
}

// Busca os dados do usuário a ser editado
$usuario = buscarUsuarioPorId($conexao, $_GET['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
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
        <h1>Editar Usuário</h1>
        <!-- Formulário para editar o usuário -->
        <form action="admin_editar_usuario.php?id=<?php echo $usuario['id']; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
            <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            <select name="tipo">
                <option value="comum" <?php echo ($usuario['tipo'] === 'comum') ? 'selected' : ''; ?>>Comum</option>
                <option value="admin" <?php echo ($usuario['tipo'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
            <button type="submit" name="atualizar">Atualizar Usuário</button>
        </form>
    </div>
</body>
</html>