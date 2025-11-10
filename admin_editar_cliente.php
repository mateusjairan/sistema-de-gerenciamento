<?php
session_start();
include 'funcoes.php';

// Verifica se o usuário está logado e se é um administrador.
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Lógica para atualizar o cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
    atualizarCliente($conexao, $_POST['id'], $_POST['nome'], $_POST['email'], $_POST['telefone'], $_POST['endereco']);
    header('Location: admin_clientes.php');
    exit;
}

// Busca os dados do cliente a ser editado
$cliente = buscarClientePorId($conexao, $_GET['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
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
        <h1>Editar Cliente</h1>
        <!-- Formulário para editar o cliente -->
        <form action="admin_editar_cliente.php?id=<?php echo $cliente['id']; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
            <input type="text" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" required>
            <input type="text" name="telefone" value="<?php echo htmlspecialchars($cliente['telefone']); ?>">
            <textarea name="endereco"><?php echo htmlspecialchars($cliente['endereco']); ?></textarea>
            <button type="submit" name="atualizar">Atualizar Cliente</button>
        </form>
    </div>
</body>
</html>