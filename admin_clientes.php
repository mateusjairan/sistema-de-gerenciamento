<?php
session_start();
include 'funcoes.php';

// Verifica se o usuário está logado e se é um administrador.
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Lógica para adicionar, editar ou excluir clientes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['adicionar'])) {
        adicionarCliente($conexao, $_POST['nome'], $_POST['email'], $_POST['telefone'], $_POST['endereco']);
    } elseif (isset($_POST['excluir'])) {
        excluirCliente($conexao, $_POST['id']);
    }
    header('Location: admin_clientes.php');
    exit;
}

$clientes = listarClientes($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Clientes</title>
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
        <h1>Gerenciar Clientes</h1>

        <!-- Formulário para adicionar um novo cliente -->
        <h2>Adicionar Novo Cliente</h2>
        <form action="admin_clientes.php" method="post">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="text" name="telefone" placeholder="Telefone">
            <textarea name="endereco" placeholder="Endereço"></textarea>
            <button type="submit" name="adicionar">Adicionar Cliente</button>
        </form>

        <!-- Tabela com a lista de clientes -->
        <h2>Clientes Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente) : ?>
                    <tr>
                        <td><?php echo $cliente['id']; ?></td>
                        <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['endereco']); ?></td>
                        <td>
                            <a href="admin_editar_cliente.php?id=<?php echo $cliente['id']; ?>" class="botao-editar">Editar</a>
                            <form action="admin_clientes.php" method="post" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
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