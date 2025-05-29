<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação de Código</title>
    <!-- Incluindo o arquivo CSS -->
    <link rel="stylesheet" href="style/validar_codigo.css">
</head>
<body>
    <div class="message-box">
        <?php
        session_start(); // Iniciar a sessão para acessar o código armazenado

        if (isset($_POST['validar_codigo'])) {
            $codigo_informado = $_POST['codigo'];

            // Verificar se o código informado corresponde ao código gerado
            if ($codigo_informado == $_SESSION['codigo_recuperacao']) {
                echo "<div class='valid-message'>Código válido! Você pode redefinir sua senha.</div><br>";
                echo "<a href='redefinir_senha.php'>Clique aqui para redefinir sua senha.</a>";
            } else {
                echo "<div class='invalid-message'>Código inválido! Tente novamente.</div><br>";
                echo "<a href='recuperacao.php'>Voltar para a página de recuperação.</a>";
            }
        } else {
            echo "<div class='invalid-message'>Nenhum código foi enviado para validação.</div><br>";
            echo "<a href='recuperacao.php'>Voltar para a página de recuperação.</a>";
        }
        ?>
    </div>
</body>
</html>
