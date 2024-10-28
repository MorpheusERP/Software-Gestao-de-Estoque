CREATE TABLE usuarios (
    id_Usuario INT(11) AUTO_INCREMENT PRIMARY KEY,
    nivel_Usuario VARCHAR(11) NOT NULL,
    nome_Usuario VARCHAR(120) NOT NULL,
    sobrenome VARCHAR(120) NOT NULL,
    funcao VARCHAR(120) NOT NULL,
    logi VARCHAR(120) NOT NULL UNIQUE,
    senha VARCHAR(20) NOT NULL
);
