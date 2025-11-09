// Aguarda o carregamento completo do DOM antes de executar o código.
document.addEventListener('DOMContentLoaded', function() {
    // Seleciona os elementos do DOM necessários para a aplicação.
    const formularioTarefa = document.getElementById('formulario-tarefa');
    const listaTarefas = document.getElementById('lista-tarefas');
    const tituloInput = document.getElementById('titulo');

    // Adiciona um ouvinte de evento para o envio do formulário.
    formularioTarefa.addEventListener('submit', function(evento) {
        // Valida se o campo de título não está vazio.
        const titulo = tituloInput.value.trim();
        if (titulo === '') {
            evento.preventDefault();
            alert('Por favor, insira um título para a tarefa.');
        }
    });

    // Adiciona um ouvinte de evento para cliques na lista de tarefas (delegação de eventos).
    listaTarefas.addEventListener('click', function(evento) {
        // Verifica se o elemento clicado é o botão de excluir.
        if (evento.target.classList.contains('botao-excluir')) {
            // Pede confirmação ao usuário antes de excluir a tarefa.
            const confirmacao = confirm('Tem certeza de que deseja excluir esta tarefa?');
            if (confirmacao) {
                // Obtém o ID da tarefa a ser excluída.
                const id = evento.target.parentElement.parentElement.dataset.id;
                // Chama a função para excluir a tarefa.
                excluirTarefa(id);
            }
        }
    });

    /**
     * Adiciona uma nova tarefa.
     * Atualmente, esta função apenas limpa o formulário e recarrega a lista de tarefas.
     * A lógica de adição real é tratada no backend (index.php).
     */
    function adicionarTarefa() {
        console.log('Adicionando tarefa...');
        // Limpa os campos do formulário.
        tituloInput.value = '';
        document.getElementById('descricao').value = '';
        document.getElementById('data-vencimento').value = '';
        document.getElementById('prioridade').value = 'baixa';
        // Recarrega a lista de tarefas para exibir a nova tarefa.
        carregarTarefas();
    }

    /**
     * Exclui uma tarefa.
     * Atualmente, esta função apenas exibe uma mensagem no console e recarrega a lista de tarefas.
     * A lógica de exclusão real é tratada no backend (index.php).
     * @param {number} id O ID da tarefa a ser excluída.
     */
    function excluirTarefa(id) {
        console.log(`Excluindo tarefa com ID: ${id}`);
        // Recarrega a lista de tarefas para remover a tarefa excluída.
        carregarTarefas();
    }

    /**
     * Carrega as tarefas do servidor.
     * Atualmente, esta função apenas limpa a lista de tarefas.
     * A lógica de carregamento real é tratada no backend (index.php).
     */
    function carregarTarefas() {
        console.log('Carregando tarefas...');
        // Limpa a lista de tarefas antes de recarregar.
        listaTarefas.innerHTML = '';
    }

    // Carrega as tarefas ao carregar a página.
    carregarTarefas();
});
