<?php
include_once("../config/config.php"); // Inclui a configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
    $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : null;
    $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : null;
    $uf = isset($_POST['uf']) ? $_POST['uf'] : null;
    $cep = isset($_POST['cep']) ? $_POST['cep'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $celular = isset($_POST['celular']) ? $_POST['celular'] : null;

    if ($nome && $endereco && $bairro && $cidade && $uf && $cep && $email && $celular) {
        // Verifica se o e-mail já está cadastrado
        $verifica_usuario = mysqli_query($conexao, "SELECT * FROM clientes WHERE email = '$email'");
        
        if (mysqli_num_rows($verifica_usuario) == 0) {
            // Insere o novo cliente no banco de dados
            $query = "INSERT INTO clientes (nome, endereco, bairro, cidade, uf, cep, celular, email, datcad, datalt, usuario_cad, usuario_alt)
                      VALUES ('$nome', '$endereco', '$bairro', '$cidade', '$uf', '$cep', '$celular', '$email', CURDATE(), CURDATE(), USER(), USER())";
            
            if (mysqli_query($conexao, $query)) {
                echo "<script>alert('Cliente cadastrado com sucesso!'); window.location.href='../index.php';</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar cliente.');</script>";
            }
        } else {
            echo "<script>alert('E-mail já cadastrado!');</script>";
        }
    } else {
        echo "<script>alert('Preencha todos os campos!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="style/criar.css">
</head>
<body>
    <div class="container">
        <h2>Cadastrar Cliente</h2>
        <form method="POST" action="./criar.php">
            <label>Nome:</label>
            <input type="text" name="nome" required> <br>

            <label>Endereço:</label>
            <input type="text" name="endereco" required> <br>

            <label>Bairro:</label>
            <input type="text" name="bairro" required> <br>

            <label>Cidade:</label>
            <input type="text" name="cidade" required> <br>

            <label>UF:</label>
            <input type="text" name="uf" required maxlength="2"> <br>

            <label>CEP:</label>
            <input type="text" name="cep" required maxlength="8"> <br>

            <label>Email:</label>
            <input type="email" name="email" required> <br>

            <label>Celular:</label>
            <input type="text" name="celular" required> <br>

            <input type="submit" value="Cadastrar">
        </form>

        <a href="../index.php" class="voltar">Voltar</a>
    </div>
</body>
</html>