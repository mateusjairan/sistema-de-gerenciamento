<?php
session_start();
include 'funcoes.php';

// Verifica se o usuário está logado e se é um administrador.
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Lógica para adicionar, editar ou excluir usuários
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['adicionar'])) {
        adicionarUsuario($conexao, $_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['tipo']);
    } elseif (isset($_POST['excluir'])) {
        excluirUsuario($conexao, $_POST['id']);
    }
    header('Location: admin_usuarios.php');
    exit;
}

$usuarios = listarUsuarios($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
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
        <h1>Gerenciar Usuários</h1>

        <!-- Formulário para adicionar um novo usuário -->
        <h2>Adicionar Novo Usuário</h2>
        <form action="admin_usuarios.php" method="post">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <select name="tipo">
                <option value="comum">Comum</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" name="adicionar">Adicionar Usuário</button>
        </form>

        <!-- Tabela com a lista de usuários -->
        <h2>Usuários Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                        <td><?php echo $usuario['tipo']; ?></td>
                        <td>
                            <a href="admin_editar_usuario.php?id=<?php echo $usuario['id']; ?>" class="botao-editar">Editar</a>
                            <form action="admin_usuarios.php" method="post" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                                <button type="submit" name="excluir" class="botao-excluir">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>