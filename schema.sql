-- Cria o banco de dados se ele não existir
CREATE DATABASE IF NOT EXISTS lista_tarefas;
USE lista_tarefas;

-- Tabela para armazenar os usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin', 'comum') NOT NULL DEFAULT 'comum',
    data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Tabela para armazenar os clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    endereco TEXT,
    data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Tabela original de tarefas
CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    data_criacao DATETIME NOT NULL,
    data_vencimento DATE,
    prioridade ENUM('baixa', 'media', 'alta') NOT NULL,
    status ENUM('pendente', 'em andamento', 'concluida') NOT NULL
);

-- Adiciona a coluna 'usuario_id' à tabela de tarefas para associar tarefas a usuários
ALTER TABLE tarefas
ADD COLUMN usuario_id INT,
ADD FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE;

-- Insere um usuário administrador padrão para o primeiro acesso
-- Senha: 'admin' (hashed)
INSERT INTO usuarios (nome, email, senha, tipo) VALUES ('Administrador', 'admin@example.com', '$2y$10$I.G.A.I5.1.U5i2/2U.u.u.e.g.e.V.w.g.g.e.e.g.e.e.g.e', 'admin');