<?php
include_once("../config/config.php"); // Conexão com o banco de dados

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);

    // Verifica se o cliente existe
    $consulta = mysqli_query($conexao, "SELECT * FROM clientes WHERE email = '$email' AND ativo = 'true'");

    if ($consulta && mysqli_num_rows($consulta) > 0) {
        // Desativa o cliente
        $query = "UPDATE clientes SET ativo = 'false', datalt = CURDATE() WHERE email = '$email'";

        if (mysqli_query($conexao, $query)) {
            $mensagem = "<div class='success-message'>Cliente desativado com sucesso!</div>";
        } else {
            $mensagem = "<div class='error-message'>Erro ao desativar cliente.</div>";
        }
    } else {
        $mensagem = "<div class='error-message'>Nenhum cliente ativo encontrado com esse e-mail.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Desativar Cliente</title>
    <link rel="stylesheet" href="style/deletar.css">
</head>
<body>
    <div class="container">
        <h2>Desativar Cliente</h2>
        <form method="POST">
            <label for="email">Digite o e-mail do cliente:</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="Desativar">
        </form>
        <?php echo $mensagem; ?>
        <a href="../index.php" class="voltar">Voltar</a>
    </div>
</body>
</html>