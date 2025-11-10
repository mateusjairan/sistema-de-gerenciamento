// Aguarda o carregamento completo do DOM antes de executar o código.
document.addEventListener('DOMContentLoaded', function() {
    // Adiciona um ouvinte de evento para o envio do formulário de tarefas.
    const formularioTarefa = document.getElementById('formulario-tarefa');
    if (formularioTarefa) {
        formularioTarefa.addEventListener('submit', function(evento) {
            // Valida se o campo de título não está vazio.
            const tituloInput = document.getElementById('titulo');
            const titulo = tituloInput.value.trim();
            if (titulo === '') {
                evento.preventDefault();
                alert('Por favor, insira um título para a tarefa.');
            }
        });
    }

    // Adiciona um ouvinte de evento para cliques em qualquer lugar da página para lidar com exclusões.
    document.body.addEventListener('click', function(evento) {
        // Verifica se o elemento clicado é um botão de excluir.
        if (evento.target.classList.contains('botao-excluir')) {
            // Pede confirmação ao usuário antes de prosseguir.
            const confirmacao = confirm('Tem certeza de que deseja excluir este item?');
            if (!confirmacao) {
                // Se o usuário clicar em "Cancelar", previne a submissão do formulário.
                evento.preventDefault();
            }
        }
    });
});
