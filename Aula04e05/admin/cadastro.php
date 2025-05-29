<?php
include_once("../config/config.php"); // Inclui a configuração do banco de dados

// Inicializar a variável de resposta
$resposta = "";

if (isset($_POST['submit'])) {
    // Obter dados do formulário
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $email_recuperacao = mysqli_real_escape_string($conexao, $_POST['email_recuperacao']);
    $senha = $_POST['senha'];

    // Validação do comprimento da senha
    if (strlen($senha) > 8) {
        $resposta = "<div class='error-message'>Erro: A senha deve ter no máximo 8 caracteres.</div>";
    } else {
        // Criptografar a senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Data do cadastro e valores padrão
        $data_cad = date('Y-m-d');
        $ativo = 'true';
        $nivel = 1;

        // Inserir no banco de dados
        $query = "INSERT INTO usuarios (nome, email, email_recup, senha, data_cad, ativo, nivel) 
                  VALUES ('$nome', '$email', '$email_recuperacao', '$senha_hash', '$data_cad', '$ativo', $nivel)";
        
        if (mysqli_query($conexao, $query)) {
            $resposta = "<div class='success-message'>Usuário cadastrado com sucesso!<br>
                         <a href='./login.php'>Clique aqui para fazer login.</a></div>";
        } else {
            $resposta = "<div class='error-message'>Erro ao cadastrar o usuário: " . mysqli_error($conexao) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style/cadastro.css"> <!-- Inclua o CSS -->
</head>
<body>
    <form action="./cadastro.php" method="POST">
        <label for="nome">Nome:</label> <br>
        <input type="text" id="nome" name="nome" required> <br> <br>

        <label for="email">E-mail:</label> <br>
        <input type="email" id="email" name="email" required> <br> <br>

        <label for="email_recuperacao">E-mail de Recuperação:</label> <br>
        <input type="email" id="email_recuperacao" name="email_recuperacao" required> <br> <br>

        <label for="senha">Senha:</label> <br>
        <input type="password" id="senha" name="senha" maxlength="8" required> <br> <br>

        <button type="submit" name="submit">Cadastrar</button> <br><br>
        <!-- Exibir a mensagem de resposta abaixo do botão -->
        <?php echo $resposta; ?>
    </form>
</body>
</html>