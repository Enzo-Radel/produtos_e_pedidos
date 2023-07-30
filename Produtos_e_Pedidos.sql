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

CREATE TABLE pedidos (
	id INT PRIMARY KEY AUTO_INCREMENT,
    cliente VARCHAR(255),
    data DATE
);

CREATE TABLE pedidos_produtos (
    pedido_id INT,
    produto_id INT,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
	FOREIGN KEY (produto_id) REFERENCES produtos(id),
    
    quantidade INT NOT NULL,
    
    PRIMARY KEY(pedido_id,produto_id)
);