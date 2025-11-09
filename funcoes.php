<?php
// Inclui o arquivo de conexão com o banco de dados.
include 'banco.php';

/**
 * Adiciona uma nova tarefa ao banco de dados.
 *
 * @param mysqli $conexao A conexão com o banco de dados.
 * @param string $titulo O título da tarefa.
 * @param string $descricao A descrição da tarefa.
 * @param string $dataVencimento A data de vencimento da tarefa.
 * @param string $prioridade A prioridade da tarefa.
 * @return bool Retorna true se a tarefa foi adicionada com sucesso, false caso contrário.
 */
function adicionarTarefa($conexao, $titulo, $descricao, $dataVencimento, $prioridade) {
    $status = 'pendente';
    $dataCriacao = date('Y-m-d H:i:s');
    $sql = "INSERT INTO tarefas (titulo, descricao, data_criacao, data_vencimento, prioridade, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $titulo, $descricao, $dataCriacao, $dataVencimento, $prioridade, $status);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

/**
 * Lista todas as tarefas do banco de dados.
 *
 * @param mysqli $conexao A conexão com o banco de dados.
 * @return array Um array com todas as tarefas.
 */
function listarTarefas($conexao) {
    $sql = "SELECT * FROM tarefas ORDER BY data_criacao DESC";
    $resultado = mysqli_query($conexao, $sql);
    $tarefas = [];
    if (mysqli_num_rows($resultado) > 0) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $tarefas[] = $linha;
        }
    }
    return $tarefas;
}

/**
 * Atualiza uma tarefa existente no banco de dados.
 *
 * @param mysqli $conexao A conexão com o banco de dados.
 * @param int $id O ID da tarefa a ser atualizada.
 * @param string $titulo O novo título da tarefa.
 * @param string $descricao A nova descrição da tarefa.
 * @param string $dataVencimento A nova data de vencimento da tarefa.
 * @param string $prioridade A nova prioridade da tarefa.
 * @param string $status O novo status da tarefa.
 * @return bool Retorna true se a tarefa foi atualizada com sucesso, false caso contrário.
 */
function atualizarTarefa($conexao, $id, $titulo, $descricao, $dataVencimento, $prioridade, $status) {
    $sql = "UPDATE tarefas SET titulo = ?, descricao = ?, data_vencimento = ?, prioridade = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $titulo, $descricao, $dataVencimento, $prioridade, $status, $id);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

/**
 * Exclui uma tarefa do banco de dados.
 *
 * @param mysqli $conexao A conexão com o banco de dados.
 * @param int $id O ID da tarefa a ser excluída.
 * @return bool Retorna true se a tarefa foi excluída com sucesso, false caso contrário.
 */
function excluirTarefa($conexao, $id) {
    $sql = "DELETE FROM tarefas WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

/**
 * Busca uma tarefa pelo seu ID.
 *
 * @param mysqli $conexao A conexão com o banco de dados.
 * @param int $id O ID da tarefa a ser buscada.
 * @return array|null Retorna um array com os dados da tarefa, ou null se não for encontrada.
 */
function buscarTarefaPorId($conexao, $id) {
    $sql = "SELECT * FROM tarefas WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $tarefa = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);
    return $tarefa;
}
?>