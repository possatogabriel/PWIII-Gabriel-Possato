<?php
include_once("../config/config.php"); // Conexão com o banco de dados

// Inicializando variáveis
$mensagem = "";
$usuario = [
    'id' => '',
    'nome' => '',
    'email' => '',
    'email_recup' => '',
    'nivel' => '',
    'data_cad' => '',
    'data_alt' => '',
    'celular_cliente' => '',
    'celular_vendedor' => '',
    'endereco' => '',
    'bairro' => '',
    'cidade' => '',
    'uf' => '',
    'cep' => '',
    'atuacao' => '',
    'comissao' => ''
];

// Buscar usuário pelo e-mail
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar_email'])) {
    $email = mysqli_real_escape_string($conexao, $_POST['buscar_email']);

    $query = "SELECT u.id, u.nome, u.email, u.email_recup, u.nivel, u.data_cad, u.data_alt, 
                     c.endereco, c.bairro, c.cidade, c.uf, c.cep, c.celular AS celular_cliente, 
                     v.celular AS celular_vendedor, v.atuacao, v.comissao 
              FROM usuarios u 
              LEFT JOIN clientes c ON u.id = c.id_usuario
              LEFT JOIN vendedores v ON u.id = v.id_usuario
              WHERE u.email = '$email'";
              
    $result = mysqli_query($conexao, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);
    } else {
        $mensagem = "Usuário não encontrado. Verifique o e-mail informado.";
    }
}

// Processa atualização dos dados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && $_POST['id'] !== '') {
    $id_usuario = intval($_POST['id']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email_recup = mysqli_real_escape_string($conexao, $_POST['email_recup']);
    $senha = $_POST['senha'];
    $data_alt = date('Y-m-d H:i:s'); // Atualiza apenas `data_alt`
    $usuario_alt = "Admin";
    $nivel = intval($_POST['nivel']);

    // Criptografar a senha antes de atualizar
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Atualiza nome, email de recuperação e senha, mantendo `data_cad`
    $query_usuario = "UPDATE usuarios SET nome='$nome', email_recup='$email_recup', senha='$senha_hash', data_alt='$data_alt' WHERE id=$id_usuario";
    mysqli_query($conexao, $query_usuario);

    // Atualizar campos específicos de Cliente
    if ($nivel == 1) {
        $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
        $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
        $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
        $uf = mysqli_real_escape_string($conexao, $_POST['uf']);
        $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
        $celular = mysqli_real_escape_string($conexao, $_POST['celular_cliente']);

        $query_cliente = "UPDATE clientes SET endereco='$endereco', bairro='$bairro', cidade='$cidade', uf='$uf', cep='$cep', celular='$celular', usuario_alt='$usuario_alt' WHERE id_usuario=$id_usuario";
        
        if (!mysqli_query($conexao, $query_cliente)) {
            echo "<script>alert('Erro ao atualizar a tabela CLIENTES: " . mysqli_error($conexao) . "');</script>";
        }
    }

    // Atualizar campos específicos de Vendedor
    if ($nivel == 2) {
        $celular = mysqli_real_escape_string($conexao, $_POST['celular_vendedor']);
        $atuacao = mysqli_real_escape_string($conexao, $_POST['atuacao']);
        $comissao = floatval($_POST['comissao']);

        $query_vendedor = "UPDATE vendedores SET celular='$celular', atuacao='$atuacao', comissao='$comissao' WHERE id_usuario=$id_usuario";
        
        if (!mysqli_query($conexao, $query_vendedor)) {
            echo "<script>alert('Erro ao atualizar a tabela VENDEDORES: " . mysqli_error($conexao) . "');</script>";
        }
    }

    echo "<script>alert('Usuário atualizado com sucesso!'); window.location.href='../index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Usuários</title>
    <link rel="stylesheet" href="style/atualizar.css">
    <script>
        function mostrarCampos(nivel) {
            document.getElementById("camposCliente").style.display = (nivel == 1) ? "block" : "none";
            document.getElementById("camposVendedor").style.display = (nivel == 2) ? "block" : "none";
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Buscar Usuário</h2>
        <form method="POST">
            <label>Email:</label>
            <input type="email" name="buscar_email" required>
            <input type="submit" value="Buscar">
        </form>

        <?php if (!empty($mensagem)): ?>
            <p class="mensagem"><?php echo htmlspecialchars($mensagem); ?></p>
        <?php endif; ?>

        <?php if (!empty($usuario['id'])): ?>
            <h2>Atualizar Informações</h2>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
                <input type="hidden" name="nivel" value="<?php echo htmlspecialchars($usuario['nivel']); ?>">

                <label>Nome:</label>
                <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome'] ?? ''); ?>" required>

                <label>Email de Recuperação:</label>
                <input type="email" name="email_recup" value="<?php echo htmlspecialchars($usuario['email_recup'] ?? ''); ?>" required>

                <label>Senha:</label>
                <input type="password" name="senha" required maxlength="8">

                <input type="hidden" id="nivel" value="<?php echo htmlspecialchars($usuario['nivel']); ?>" onchange="mostrarCampos(this.value)">

                <?php if ($usuario['nivel'] == 1): ?>
                <div id="camposCliente">
                    <label>Endereço:</label>
                    <input type="text" name="endereco" value="<?php echo htmlspecialchars($usuario['endereco'] ?? ''); ?>">
                    <label>Bairro:</label>
                    <input type="text" name="bairro" value="<?php echo htmlspecialchars($usuario['bairro'] ?? ''); ?>">
                    <label>Cidade:</label>
                    <input type="text" name="cidade" value="<?php echo htmlspecialchars($usuario['cidade'] ?? ''); ?>">
                    <label>UF:</label>
                    <input type="text" name="uf" value="<?php echo htmlspecialchars($usuario['uf'] ?? ''); ?>" maxlength="2">
                    <label>CEP:</label>
                    <input type="text" name="cep" value="<?php echo htmlspecialchars($usuario['cep'] ?? ''); ?>"  maxlength="8">
                    <label>Celular:</label>
                    <input type="text" name="celular_cliente" value="<?php echo htmlspecialchars($usuario['celular_cliente'] ?? ''); ?>" maxlength="9">
                </div>
                <?php endif; ?>

                <?php if ($usuario['nivel'] == 2): ?>
                <div id="camposVendedor">
                    <label>Celular:</label>
                    <input type="text" name="celular_vendedor" value="<?php echo htmlspecialchars($usuario['celular_vendedor'] ?? ''); ?>" maxlength="9">
                    <label>Atuação:</label>
                    <input type="text" name="atuacao" value="<?php echo htmlspecialchars($usuario['atuacao'] ?? ''); ?>" maxlength="2">
                    <label>Comissão (%):</label>
                    <input type="number" name="comissao" step="0.01" value="<?php echo htmlspecialchars($usuario['comissao'] ?? ''); ?>">
                </div>
                <?php endif; ?>

                <input type="submit" value="Atualizar">
            </form>
        <?php endif; ?>

        <a href="../index.php" class="voltar">Voltar</a>
    </div>
</body>
</html>