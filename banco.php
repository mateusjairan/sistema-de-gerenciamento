<?php
// Configurações para exibir todos os erros do PHP, útil para depuração.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Habilita o relatório de erros do MySQLi, lançando exceções em caso de falhas.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Definição das credenciais de acesso ao banco de dados.
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "lista_tarefas";

try {
    // Tenta estabelecer a conexão com o banco de dados.
    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
    // Define o conjunto de caracteres para UTF-8, garantindo a correta exibição de caracteres especiais.
    mysqli_set_charset($conexao, "utf8");
} catch (mysqli_sql_exception $e) {
    // Se a conexão falhar, exibe uma mensagem de erro e encerra a execução do script.
    die("Falha na conexão: " . $e->getMessage());
}
?>