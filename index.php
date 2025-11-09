<?php
// Inclui o arquivo de funções, que contém a lógica de CRUD (Criar, Ler, Atualizar, Excluir) para as tarefas.
include 'funcoes.php';

// Verifica se a requisição é do tipo POST, o que indica que um formulário foi enviado.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se o botão 'adicionar' foi pressionado, chama a função para adicionar uma nova tarefa.
    if (isset($_POST['adicionar'])) {
        adicionarTarefa($conexao, $_POST['titulo'], $_POST['descricao'], $_POST['data_vencimento'], $_POST['prioridade']);
    // Se o botão 'excluir' foi pressionado, chama a função para excluir a tarefa correspondente.
    } elseif (isset($_POST['excluir'])) {
        excluirTarefa($conexao, $_POST['id']);
    // Se o botão 'atualizar' foi pressionado, chama a função para atualizar os dados da tarefa.
    } elseif (isset($_POST['atualizar'])) {
        atualizarTarefa($conexao, $_POST['id'], $_POST['titulo'], $_POST['descricao'], $_POST['data_vencimento'], $_POST['prioridade'], $_POST['status']);
    }
    // Redireciona o usuário para a página principal para evitar o reenvio do formulário.
    header('Location: index.php');
    exit;
}

// Busca todas as tarefas do banco de dados para exibi-las na página.
$tarefas = listarTarefas($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="conteudo">
        <h1>Lista de Tarefas</h1>
        <!-- Formulário para adicionar uma nova tarefa -->
        <form action="index.php" method="post" id="formulario-tarefa">
            <input type="text" name="titulo" placeholder="Título" required>
            <textarea name="descricao" placeholder="Descrição"></textarea>
            <input type="date" name="data_vencimento">
            <select name="prioridade">
                <option value="baixa">Baixa</option>
                <option value="media">Média</option>
                <option value="alta">Alta</option>
            </select>
            <button type="submit" name="adicionar">Adicionar Tarefa</button>
        </form>
        <!-- Lista onde as tarefas serão exibidas -->
        <ul id="lista-tarefas">
            <?php foreach ($tarefas as $tarefa) : ?>
                <li class="tarefa prioridade-<?php echo $tarefa['prioridade']; ?>" data-id="<?php echo $tarefa['id']; ?>">
                    <div>
                        <h2><?php echo htmlspecialchars($tarefa['titulo']); ?></h2>
                        <p><?php echo htmlspecialchars($tarefa['descricao']); ?></p>
                        <p><strong>Vencimento:</strong> <?php echo date('d/m/Y', strtotime($tarefa['data_vencimento'])); ?></p>
                        <p><strong>Status:</strong> <?php echo ucfirst($tarefa['status']); ?></p>
                    </div>
                    <div class="botoes">
                        <!-- Formulário para excluir uma tarefa -->
                        <form action="index.php" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">
                            <button type="submit" name="excluir" class="botao-excluir">Excluir</button>
                        </form>
                        <!-- Botão para editar uma tarefa -->
                        <a href="editar.php?id=<?php echo $tarefa['id']; ?>" class="botao-editar">Editar</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <script src="script.js"></script>
</body>
</html>