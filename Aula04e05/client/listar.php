<?php
include_once("../config/config.php"); // Conexão com o banco de dados

// Certifique-se de que a conexão está funcionando
if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Consulta apenas usuários ATIVOS
$query = "SELECT u.id, u.nome, u.email, u.nivel FROM usuarios u WHERE u.ativo = 'true'";
$result = mysqli_query($conexao, $query);

if (!$result) {
    die("Erro na consulta ao banco de dados: " . mysqli_error($conexao));
}

// Função para definir a cor do nível
function corNivel($nivel) {
    switch ($nivel) { 
        case 1: return "#2a71bd"; // Azul médio (Blue 400) — visível e vibrante
        case 2: return "#11d151"; // Verde médio (Green 400) — mais forte que o anterior
        case 3: return "#e0e0e0"; // Cinza claro — para "outro"
        default: return "#bdbdbd"; // Cinza médio — fallback
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Usuários</title>
    <link rel="stylesheet" href="style/listar.css">
</head>
<body>
    <div class="container">
        <h2>Listar Usuários</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Nível</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($usuario = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($usuario['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($usuario['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($usuario['email']) . "</td>";
                        echo "<td style='color:" . corNivel($usuario['nivel']) . "; font-weight: bold;'>" . htmlspecialchars($usuario['nivel']) . "</td>";
                        echo "<td><a class='desativar-link' href='./deletar.php?id_usuario=" . $usuario['id'] . "&email=" . urlencode($usuario['email']) . "' onclick='return confirm(\"Tem certeza que deseja desativar este usuário?\")'>Desativar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum usuário ativo encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="../index.php" class="voltar">Voltar</a>
    </div>
</body>
</html>