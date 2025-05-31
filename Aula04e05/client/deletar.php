<?php
include_once("../config/config.php"); // Conexão com o banco de dados

$mensagem = "";
$email_preenchido = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);

    // Verifica se o usuário existe e está ativo
    $consulta = mysqli_query($conexao, "SELECT id FROM usuarios WHERE email = '$email' AND ativo = 'true'");

    if ($consulta && mysqli_num_rows($consulta) > 0) {
        // Obtém o ID do usuário
        $dados_usuario = mysqli_fetch_assoc($consulta);
        $id_usuario = $dados_usuario['id'];

        // Desativa o usuário na tabela `usuarios`
        $query_desativar_usuario = "UPDATE usuarios SET ativo = 'false', data_alt = NOW() WHERE id = '$id_usuario'";
        
        if (mysqli_query($conexao, $query_desativar_usuario)) {
            $mensagem = "<div class='success-message'>Usuário desativado com sucesso!</div>";
        } else {
            $mensagem = "<div class='error-message'>Erro ao desativar usuário.</div>";
        }
    } else {
        $mensagem = "<div class='error-message'>Nenhum usuário ativo encontrado com esse e-mail.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Desativar Usuários</title>
    <link rel="stylesheet" href="style/deletar.css">
</head>
<body>
    <div class="container">
        <h2>Desativar Usuários</h2>
        <form method="POST">
            <label for="email">Digite o e-mail do usuário:</label>
            <input type="email" id="email" name="email" required value="<?php echo $email_preenchido; ?>">
            <input type="submit" value="Desativar">
        </form>
        <?php echo $mensagem; ?>
        <a href="../index.php" class="voltar">Voltar</a>
    </div>
</body>
</html>