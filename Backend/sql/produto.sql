CREATE TABLE produtos (
    cod_Produto INT(11) PRIMARY KEY,
    imagem LONGBLOB,
    nome_Produto VARCHAR(120) NOT NULL,
    tipo_Produto VARCHAR(120) NOT NULL,
    cod_Barras INT(11) NOT NULL,
    preco_Custo DOUBLE NOT NULL,
    preco_Venda DOUBLE NOT NULL,
    grupo VARCHAR(15) NOT NULL,
    sub_Grupo VARCHAR(100) NOT NULL,
    observacao VARCHAR(120) NOT NULL
);
