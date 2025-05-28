<?php
include_once("config.php"); // Inclui a configuração do banco de dados

// Certifique-se de que a conexão está funcionando
if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Consulta usuários no banco de dados
$query = "SELECT id, nome, email FROM usuarios";
$result = mysqli_query($conexao, $query);

if (!$result) {
    die("Erro na consulta ao banco de dados: " . mysqli_error($conexao));
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários</title>
    <link rel="stylesheet" href="style/listar.css">
</head>
<body>
    <div class="container">
        <h2>Lista de Usuários</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
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
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum usuário encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="index.php" class="voltar">Voltar</a>
    </div>
</body>
</html>
