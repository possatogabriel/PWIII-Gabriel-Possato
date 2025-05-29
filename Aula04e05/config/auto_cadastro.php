<?php
include_once("config.php"); // Inclui a configuração do banco de dados

// Verifica se o usuário Gabriel já existe
$emailGabriel = 'gabriel@email.com';
$consulta = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$emailGabriel'");

if ($consulta && mysqli_num_rows($consulta) == 0) {
    // Dados do usuário Gabriel
    $nome = "Gabriel";
    $email_recuperacao = "recuperacao@email.com";
    $senha = "123"; // Senha original

    // Criptografar a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Data do cadastro e valores padrão
    $data_cad = date('Y-m-d');
    $ativo = "true";
    $nivel = 1;

    // Inserir no banco de dados
    $query = "INSERT INTO usuarios (nome, email, email_recup, senha, data_cad, ativo, nivel) 
              VALUES ('$nome', '$emailGabriel', '$email_recuperacao', '$senha_hash', '$data_cad', '$ativo', $nivel)";

    mysqli_query($conexao, $query);
}
?>