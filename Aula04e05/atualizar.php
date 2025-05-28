<?php
include_once("config.php"); // Inclui a configuração do banco de dados

// Definir valores padrão para os campos
$usuario = [
    'id' => '',
    'nome' => '',
    'email' => ''
];

// Verifica se um ID de usuário foi enviado via GET para edição
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Garante que o ID seja um número inteiro
    $query = "SELECT * FROM usuarios WHERE id = $id";
    $result = mysqli_query($conexao, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Usuário</title>
    <link rel="stylesheet" href="style/atualizar.css">
</head>
<body>
    <div class="container">
        <h2>Atualizar Usuário</h2>
        <form method="POST" action="atualizar.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required> <br>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required> <br>

            <input type="submit" value="Atualizar">
        </form>

        <a href="index.php" class="voltar">Voltar</a>
    </div>
</body>
</html>

<?php
// Processa a atualização dos dados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);

    $query = "UPDATE usuarios SET nome = '$nome', email = '$email' WHERE id = $id";
    if (mysqli_query($conexao, $query)) {
        echo "<script>alert('Usuário atualizado com sucesso!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar usuário.');</script>";
    }
}
?>