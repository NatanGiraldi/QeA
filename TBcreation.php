<?php

require_once "DataBase.php";
$sqlI = <<<EOT
CREATE TABLE IF NOT EXISTS tb_disciplinas(
    id_disciplina int not null auto_increment primary key,
    disciplina VARCHAR(41) UNIQUE 
);
EOT;
$sqlII = <<<EOT
CREATE TABLE IF NOT EXISTS tb_perguntas(
    id_pg int not null auto_increment PRIMARY KEY,
    questao VARCHAR(400),
    alternativa1 VARCHAR(100),
    alternativa2 VARCHAR(100),
    alternativa3 VARCHAR(100),
    alternativa4 VARCHAR(100),
    alt_correta int,
    id_disciplina int,
    CONSTRAINT fk_disciplina FOREIGN KEY (id_disciplina) 
    REFERENCES tb_disciplinas(id_disciplina)
);
EOT;
$sqlIII = <<<EOT
CREATE TABLE IF NOT EXISTS tb_usuarios(
    id_aluno int not null auto_increment PRIMARY KEY,
    nome VARCHAR(40),
    email VARCHAR(100),
    senha VARCHAR(10)
);
EOT;
$sqlIV = <<<EOT
CREATE TABLE IF NOT EXISTS tb_respostas(
    id_pg int,
    id_aluno int,
    resposta int,
    FOREIGN KEY (id_pg) REFERENCES tb_perguntas(id_pg),
    FOREIGN KEY (id_aluno) REFERENCES tb_usuarios(id_aluno)
);
EOT;


$sqlV = "INSERT IGNORE INTO tb_disciplinas (disciplina) VALUES ('Arquitetura e Organização de Computadores'), ('Estatistica'), ('Fundamentos de rede'), ('Otimização de Banco de Dados');";

$conn->query($sqlI);
$conn->query($sqlII);
$conn->query($sqlIII);
$conn->query($sqlIV);
$conn->query($sqlV);
?>