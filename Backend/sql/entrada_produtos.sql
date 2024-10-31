CREATE TABLE entradas (
    id_Entrada INT(11) PRIMARY KEY,
    id_Usuario INT(11) NOT NULL,
    nome_Usuario VARCHAR(120) NOT NULL,
    id_Fornecedor INT(11) NOT NULL,
    nome_Fornecedor VARCHAR(120) NOT NULL,
    cod_Produto INT(11) NOT NULL,
    nome_Produto VARCHAR(120) NOT NULL,
    id_Estoque INT(11) NOT NULL,
    qtd_Entrada FLOAT NOT NULL,
    preco_Custo DOUBLE NOT NULL,
    sub_Grupo VARCHAR (120) NOT NULL,
    valor_Total DOUBLE NOT NULL,
    data_Entrada DATE NOT NULL
);
