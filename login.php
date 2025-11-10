<?php
// Inicia a sessão para gerenciar o estado de login do usuário.
session_start();
include 'funcoes.php';

// Se o usuário já estiver logado, redireciona para a página principal.
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

$erro = '';
// Verifica se o formulário de login foi enviado.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tenta autenticar o usuário com o e-mail e a senha fornecidos.
    $usuario = autenticarUsuario($conexao, $_POST['email'], $_POST['senha']);
    if ($usuario) {
        // Se a autenticação for bem-sucedida, armazena os dados do usuário na sessão.
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_tipo'] = $usuario['tipo'];
        // Redireciona para a página principal.
        header('Location: index.php');
        exit;
    } else {
        // Se a autenticação falhar, define uma mensagem de erro.
        $erro = 'E-mail ou senha inválidos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="conteudo">
        <h1>Login</h1>
        <?php if ($erro): ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php endif; ?>
        <!-- Formulário de login -->
        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>