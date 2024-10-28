CREATE TABLE fornecedores (
    id_Fornecedor INT(11) PRIMARY KEY,
    razao_Social VARCHAR(120) NOT NULL,
    nome_Fornecedor VARCHAR(120) NOT NULL,
    apelido VARCHAR(120) NOT NULL,
    grupo VARCHAR(120) NOT NULL,
    sub_Grupo VARCHAR(120) NOT NULL,
    observacao VARCHAR(120) NOT NULL
);
