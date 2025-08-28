<?php

$host = "localhost";
$user = "root"
$senha = "root"
$database = "pwiii_db";

$conexao = new mysqli($host, $user, $senha, $database);

// Verificação de erros
if ($conexao->connect_errno) {
    die("Falha ao conectar ao banco de dados: (" . $conexao->connect_errno . ") " . $conexao->connect_error);
}

// Opcional: Definir o charset da conexão para evitar problemas com caracteres especiais
$conexao->set_charset("utf8");

?>