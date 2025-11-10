<?php
// Inclui o arquivo de conexão com o banco de dados.
include 'banco.php';

// Funções de Autenticação
function autenticarUsuario($conexao, $email, $senha) {
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        return $usuario;
    }
    return null;
}

// Funções de Tarefas
function adicionarTarefa($conexao, $titulo, $descricao, $dataVencimento, $prioridade, $usuario_id) {
    $status = 'pendente';
    $dataCriacao = date('Y-m-d H:i:s');
    $sql = "INSERT INTO tarefas (titulo, descricao, data_criacao, data_vencimento, prioridade, status, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssi", $titulo, $descricao, $dataCriacao, $dataVencimento, $prioridade, $status, $usuario_id);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function listarTarefas($conexao, $usuario_id) {
    $sql = "SELECT * FROM tarefas WHERE usuario_id = ? ORDER BY data_criacao DESC";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $usuario_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $tarefas = [];
    if (mysqli_num_rows($resultado) > 0) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $tarefas[] = $linha;
        }
    }
    mysqli_stmt_close($stmt);
    return $tarefas;
}

function atualizarTarefa($conexao, $id, $titulo, $descricao, $dataVencimento, $prioridade, $status) {
    $sql = "UPDATE tarefas SET titulo = ?, descricao = ?, data_vencimento = ?, prioridade = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $titulo, $descricao, $dataVencimento, $prioridade, $status, $id);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function excluirTarefa($conexao, $id) {
    $sql = "DELETE FROM tarefas WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

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

// Funções de Gerenciamento de Usuários (Admin)
function listarUsuarios($conexao) {
    $sql = "SELECT * FROM usuarios ORDER BY nome";
    $resultado = mysqli_query($conexao, $sql);
    $usuarios = [];
    if (mysqli_num_rows($resultado) > 0) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $usuarios[] = $linha;
        }
    }
    return $usuarios;
}

function adicionarUsuario($conexao, $nome, $email, $senha, $tipo) {
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $email, $senhaHash, $tipo);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function atualizarUsuario($conexao, $id, $nome, $email, $tipo) {
    $sql = "UPDATE usuarios SET nome = ?, email = ?, tipo = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $nome, $email, $tipo, $id);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function excluirUsuario($conexao, $id) {
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function buscarUsuarioPorId($conexao, $id) {
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);
    return $usuario;
}

// Funções de Gerenciamento de Clientes (Admin)
function listarClientes($conexao) {
    $sql = "SELECT * FROM clientes ORDER BY nome";
    $resultado = mysqli_query($conexao, $sql);
    $clientes = [];
    if (mysqli_num_rows($resultado) > 0) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $clientes[] = $linha;
        }
    }
    return $clientes;
}

function adicionarCliente($conexao, $nome, $email, $telefone, $endereco) {
    $sql = "INSERT INTO clientes (nome, email, telefone, endereco) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $email, $telefone, $endereco);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function atualizarCliente($conexao, $id, $nome, $email, $telefone, $endereco) {
    $sql = "UPDATE clientes SET nome = ?, email = ?, telefone = ?, endereco = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $nome, $email, $telefone, $endereco, $id);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function excluirCliente($conexao, $id) {
    $sql = "DELETE FROM clientes WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function buscarClientePorId($conexao, $id) {
    $sql = "SELECT * FROM clientes WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $cliente = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);
    return $cliente;
}
?>