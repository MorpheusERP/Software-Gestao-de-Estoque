CREATE TABLE saida (
    id_Saida INT(11) AUTO_INCREMENT PRIMARY KEY,
    imagem LONGBLOB,
    id_usuario INT(11) NOT NULL,
    nome_Usuario VARCHAR(32) NOT NULL,
    cod_Produto VARCHAR(32) NOT NULL,
    nome_Produto VARCHAR(32) NOT NULL,
    preco_Custo DOUBLE NOT NULL,
    id_Local INT(11) NOT NULL,
    nome_Local VARCHAR(120) NOT NULL,
    id_Estoque INT(11) NOT NULL,
    qtd_saida DOUBLE NOT NULL,
    valor_Total DOUBLE NOT NULL,
    observacao VARCHAR(120),
    data_Saida DATE NOT NULL
);
