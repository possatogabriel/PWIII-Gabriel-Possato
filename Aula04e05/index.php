<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-Vindo</title>
    <!-- Incluindo o arquivo CSS -->
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <div class="container">
        <?php
        include_once("config/config.php"); // Inclui o arquivo de configuração do banco de dados

        // Verifica se o cookie de login existe
        $login_cookie = isset($_COOKIE["login"]) ? $_COOKIE["login"] : null;

        if ($login_cookie) {
            // Valida o cookie contra o banco de dados
            $consulta = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email = '$login_cookie'");
            if ($consulta && mysqli_num_rows($consulta) > 0) {
                // Recupera os dados do usuário
                $usuario = mysqli_fetch_assoc($consulta);
                $nome = htmlspecialchars($usuario["nome"]); // Nome do usuário

                // Exibe boas-vindas ao usuário
                echo "<p> Bem-Vindo, $nome! </p>"; 
                echo "<p> Você <font color='green'>PODE</font> acessar as informações.</p>";

                // Botões CRUD + Cadastro de Cliente + Logout
                echo "<div class='buttons'>";
                echo "<a href='./client/criar.php'><button>Criar Usuário</button></a>";
                echo "<a href='./client/listar.php'><button>Listar Usuários</button></a>";
                echo "<a href='./client/atualizar.php'><button>Atualizar Usuário</button></a>";
                echo "<a href='./client/deletar.php'><button>Deletar Usuário</button></a>";
                echo "<a href='./client/logout.php'><button class='logout-btn'>Logout</button></a>";
                echo "</div>";
            } else {
                // Cookie inválido ou usuário não encontrado
                echo "<p>Cookie inválido ou expirado. <a href='admin/login.php'>Faça Login</a> novamente.</p>";
            }
        } else {
            // Cookie não existe
            echo "<p>Bem-Vindo, convidado! </p>"; 
            echo "<p> Você <font color='red'>NÃO PODE</font> acessar as informações.</p>";
            echo "<a href='admin/login.php'>Faça Login</a> para ler o conteúdo.";
        }
        ?>
    </div>
</body>
</html>
