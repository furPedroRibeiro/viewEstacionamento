create database estacionamento;
use estacionamento;

create table funcionario(
idFuncionario INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(120),
dtnasc DATE,
função VARCHAR(100),
email VARCHAR(200),
senha VARCHAR(45)
);

create table tipoVaga(
cd INT PRIMARY KEY AUTO_INCREMENT,
nomeVaga VARCHAR(100)
);

create table cliente(
idCliente INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(120),
dtnasci DATE,
id_vaga INT, 
FOREIGN KEY (id_vaga) 
REFERENCES tipoVaga(cd)
);

create table estacionamento(
idEstacionamento INT PRIMARY KEY AUTO_INCREMENT,
id_funcionario INT,
FOREIGN KEY (id_funcionario) 
REFERENCES funcionario(idFuncionario),
id_vaga INT,
FOREIGN KEY (id_vaga) 
REFERENCES tipoVaga(cd),
id_cliente INT,
FOREIGN KEY (id_cliente) 
REFERENCES cliente(idCliente)
);

create table carro(
idCarro INT PRIMARY KEY AUTO_INCREMENT,
cor VARCHAR(20),
marca VARCHAR(30),
id_cliente INT,
FOREIGN KEY (id_cliente) 
REFERENCES cliente(idCliente),
id_vaga INT,
FOREIGN KEY (id_vaga) 
REFERENCES tipoVaga(cd)
);

INSERT INTO funcionario (nome, dtnasc, função, email, senha) VALUES ('Donizete', '1980/10/25','cobrador','doni@gmail.com', md5('donidoni'));
INSERT INTO funcionario (nome, dtnasc, função, email, senha) VALUES ('Nauderi', '1980/01/07','cobrador','naulau@gmail.com', md5('amomae'));
INSERT INTO funcionario (nome, dtnasc, função, email, senha) VALUES ('Milena', '1990/05/22','cobradora','mili@gmail.com', md5('mili00'));
INSERT INTO funcionario (nome, dtnasc, função, email, senha) VALUES ('Claudia', '1980/11/25','guarda','claudia@gmail.com', md5('claudiameamo'));
INSERT INTO funcionario (nome, dtnasc, função, email, senha) VALUES ('Rodrigo', '1990/09/17','guarda','rodrigoxe@gmail.com', md5('rodrigo97'));

SELECT * FROM funcionario;

INSERT INTO tipoVaga (nomeVaga) VALUES ('Mensais');
INSERT INTO tipoVaga (nomeVaga) VALUES ('Individuais');
INSERT INTO tipoVaga (nomeVaga) VALUES ('Conveniadas');

SELECT * FROM tipoVaga;

INSERT INTO cliente (nome, dtnasci, id_vaga) VALUES ('Luzinette', '1980/03/24', '1');
INSERT INTO cliente (nome, dtnasci, id_vaga) VALUES ('Mauricio', '1985/08/15', '1');
INSERT INTO cliente (nome, dtnasci, id_vaga) VALUES ('Vitoria', '1982/03/12', '3');
INSERT INTO cliente (nome, dtnasci, id_vaga) VALUES ('Andressa', '1988/09/17', '3');
INSERT INTO cliente (nome, dtnasci, id_vaga) VALUES ('Pedro Henrique', '2000/10/22', '1');
INSERT INTO cliente (nome, dtnasci, id_vaga) VALUES ('Luciano', '1989/02/08', '1');
INSERT INTO cliente (nome, dtnasci, id_vaga) VALUES ('Jaivan', '1980/07/01', '1');

SELECT * FROM cliente;

INSERT INTO carro (cor, marca, id_cliente, id_vaga) VALUES ('vermelho', 'Chevrolet', '1', '1');
INSERT INTO carro (cor, marca, id_cliente, id_vaga) VALUES ('preto', 'Fiat', '2', '1');
INSERT INTO carro (cor, marca, id_cliente, id_vaga) VALUES ('cinza', 'BMW', '3', '3');
INSERT INTO carro (cor, marca, id_cliente, id_vaga) VALUES ('prata', 'HONDA', '4', '3');
INSERT INTO carro (cor, marca, id_cliente, id_vaga) VALUES ('marrom', 'GOL', '5', '1');
INSERT INTO carro (cor, marca, id_cliente, id_vaga) VALUES ('branco', 'HB20', '6', '1');
INSERT INTO carro (cor, marca, id_cliente, id_vaga) VALUES ('preto', 'Fiat', '7', '1');



