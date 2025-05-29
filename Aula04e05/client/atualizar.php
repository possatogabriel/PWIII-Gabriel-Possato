<?php
include_once("../config/config.php"); // Configuração do banco de dados

// Inicializando variáveis
$mensagem = "";
$cliente = [
    'id_cliente' => '',
    'nome' => '',
    'endereco' => '',
    'bairro' => '',
    'cidade' => '',
    'uf' => '',
    'cep' => '',
    'celular' => '',
    'email' => '',
    'datcad' => '',
    'datalt' => '',
    'usuario_cad' => '',
    'usuario_alt' => ''
];

// Verifica se o e-mail foi enviado via POST para buscar o cliente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar_email'])) {
    $email = mysqli_real_escape_string($conexao, $_POST['buscar_email']);
    $query = "SELECT id_cliente, nome, endereco, bairro, cidade, uf, cep, celular, email FROM clientes WHERE email = '$email'";
    $result = mysqli_query($conexao, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $cliente = mysqli_fetch_assoc($result);
    } else {
        $mensagem = "Cliente não encontrado. Verifique o e-mail informado.";
    }
}

// Processa a atualização dos dados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_cliente']) && $_POST['id_cliente'] !== '') {
    $id_cliente = intval($_POST['id_cliente']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
    $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $uf = mysqli_real_escape_string($conexao, $_POST['uf']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
    $celular = mysqli_real_escape_string($conexao, $_POST['celular']);
    $usuario_alt = "SEU_USUARIO"; // Substitua pelo nome do usuário real

    $query = "UPDATE clientes SET 
        nome = '$nome', endereco = '$endereco', bairro = '$bairro',
        cidade = '$cidade', uf = '$uf', cep = '$cep', celular = '$celular',
        datalt = NOW(), usuario_alt = '$usuario_alt' 
    WHERE id_cliente = $id_cliente";

    if (mysqli_query($conexao, $query)) {
        echo "<script>alert('Cliente atualizado com sucesso!'); window.location.href='../index.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar cliente.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Clientes</title>
    <link rel="stylesheet" href="style/atualizar.css">
</head>
<body>
    <div class="container">
        <h2>Buscar Clientes</h2>
        <form method="POST">
            <label>Email:</label>
            <input type="email" name="buscar_email" required>
            <input type="submit" value="Buscar">
        </form>

        <?php if (!empty($mensagem)): ?>
            <p class="mensagem"><?php echo htmlspecialchars($mensagem); ?></p>
        <?php endif; ?>

        <?php if (!empty($cliente['id_cliente'])): ?>
            <h2>Atualizar Informações</h2>
            <form method="POST">
                <input type="hidden" name="id_cliente" value="<?php echo htmlspecialchars($cliente['id_cliente']); ?>">

                <label>Nome:</label>
                <input type="text" name="nome" value="<?php echo htmlspecialchars($cliente['nome'] ?? ''); ?>" required>

                <label>Endereço:</label>
                <input type="text" name="endereco" value="<?php echo htmlspecialchars($cliente['endereco'] ?? ''); ?>" required>

                <label>Bairro:</label>
                <input type="text" name="bairro" value="<?php echo htmlspecialchars($cliente['bairro'] ?? ''); ?>" required>

                <label>Cidade:</label>
                <input type="text" name="cidade" value="<?php echo htmlspecialchars($cliente['cidade'] ?? ''); ?>" required>

                <label>UF:</label>
                <input type="text" name="uf" value="<?php echo htmlspecialchars($cliente['uf'] ?? ''); ?>" required>

                <label>CEP:</label>
                <input type="text" name="cep" value="<?php echo htmlspecialchars($cliente['cep'] ?? ''); ?>" required>

                <label>Celular:</label>
                <input type="text" name="celular" value="<?php echo htmlspecialchars($cliente['celular'] ?? ''); ?>" required>

                <input type="submit" value="Atualizar">
            </form>
        <?php endif; ?>

        <a href="../index.php" class="voltar">Voltar</a>
    </div>
</body>
</html>