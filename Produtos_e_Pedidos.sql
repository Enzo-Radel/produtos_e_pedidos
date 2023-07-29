CREATE DATABASE produtos_e_pedidos;

USE produtos_e_pedidos;

CREATE TABLE produtos (
	id INT PRIMARY KEY,
    descricao VARCHAR(255),
    valor_venda FLOAT,
    estoque INT
);

CREATE TABLE imagens_de_produtos(
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255),
    produto_id INT NOT NULL,
    
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);