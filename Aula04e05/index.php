<?php
include_once("config/config.php");

$login_cookie = isset($_COOKIE["login"]) ? $_COOKIE["login"] : null;
$tema = "tema-claro"; // Tema padrão
$usuario_logado = false;
$cookie_invalido = false;

if ($login_cookie) {
    $consulta = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$login_cookie'");
    if ($consulta && mysqli_num_rows($consulta) > 0) {
        $usuario = mysqli_fetch_assoc($consulta);
        $nome = htmlspecialchars($usuario["nome"]);
        $tema = "tema-escuro";
        $usuario_logado = true;
    } else {
        $cookie_invalido = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-Vindo</title>
    <link rel="stylesheet" href="./style/index.css">
</head>
<body class="<?php echo $tema; ?>">
    <div class="container">
        <?php if ($usuario_logado): ?>
           <p> Bem-vindo, <?php echo $nome; ?>!</p>
            <p>Você tem acesso às informações de <font color='green'>ADMINISTRADOR</font>.</p>
            <div class="buttons">
                <a href="./client/criar.php"><button>Criar Usuários</button></a>
                <a href="./client/listar.php"><button>Listar Usuários</button></a>
                <a href="./client/atualizar.php"><button>Atualizar Usuários</button></a>
                <a href="./client/deletar.php"><button>Desativar Usuários</button></>
            </div>
            <div class="logout-container">
                <a href="./client/logout.php"><button class="logout-btn">Logout</button></a>
            </div>
        <?php elseif ($cookie_invalido): ?>
            <p>Cookie inválido ou expirado.</p>
            <a href='admin/login.php'>Faça Login</a> novamente.
        <?php else: ?>
            <p>Bem-Vindo, convidado!</p>
            <p>Você <font color='red'>NÃO PODE</font> acessar as informações.</p>
            <a href='admin/login.php'>Faça Login</a> para ler o conteúdo.
        <?php endif; ?>
    </div>
</body>
</html>