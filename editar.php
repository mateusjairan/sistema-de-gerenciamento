<?php
include 'funcoes.php';

// Verifica se o ID da tarefa foi passado na URL.
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$tarefa = buscarTarefaPorId($conexao, $id);

// Se a tarefa não for encontrada, redireciona para a página principal.
if (!$tarefa) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="conteudo">
        <h1>Editar Tarefa</h1>
        <!-- Formulário para editar a tarefa -->
        <form action="index.php" method="post">
            <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
            <input type="text" name="titulo" placeholder="Título" value="<?php echo htmlspecialchars($tarefa['titulo']); ?>" required>
            <textarea name="descricao" placeholder="Descrição"><?php echo htmlspecialchars($tarefa['descricao']); ?></textarea>
            <input type="date" name="data_vencimento" value="<?php echo $tarefa['data_vencimento']; ?>">
            <select name="prioridade">
                <option value="baixa" <?php echo ($tarefa['prioridade'] === 'baixa') ? 'selected' : ''; ?>>Baixa</option>
                <option value="media" <?php echo ($tarefa['prioridade'] === 'media') ? 'selected' : ''; ?>>Média</option>
                <option value="alta" <?php echo ($tarefa['prioridade'] === 'alta') ? 'selected' : ''; ?>>Alta</option>
            </select>
            <select name="status">
                <option value="pendente" <?php echo ($tarefa['status'] === 'pendente') ? 'selected' : ''; ?>>Pendente</option>
                <option value="em andamento" <?php echo ($tarefa['status'] === 'em andamento') ? 'selected' : ''; ?>>Em Andamento</option>
                <option value="concluida" <?php echo ($tarefa['status'] === 'concluida') ? 'selected' : ''; ?>>Concluída</option>
            </select>
            <button type="submit" name="atualizar">Atualizar Tarefa</button>
        </form>
    </div>
</body>
</html>