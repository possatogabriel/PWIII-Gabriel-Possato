<?php

// Configuração do banco de dados
$hostname = "localhost";
$bancodedados = "pwiii_db";
$usuario = "root";
$senha = "";

// Conexão com o banco de dados
$conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);

// Verificação de erros
if ($conexao->connect_errno) {
    die("Falha ao conectar ao banco de dados: (" . $conexao->connect_errno . ") " . $conexao->connect_error);
}

// Opcional: Definir o charset da conexão para evitar problemas com caracteres especiais
$conexao->set_charset("utf8");
?>
