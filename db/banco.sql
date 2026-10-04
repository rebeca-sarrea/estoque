CREATE DATABASE IF NOT EXISTS estoque CHARACTER SET utf8mb4;
USE estoque;

CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    validade DATE NOT NULL
);

INSERT INTO produtos (nome, categoria, descricao, preco, quantidade, validade) VALUES
('Arroz 5kg', 'Grãos', 'Arroz branco tipo 1', 25.90, 40, '2027-06-30'),
('Leite 1L', 'Laticínios', 'Leite integral', 5.49, 100, '2026-12-15');
