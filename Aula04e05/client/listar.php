<?php
include_once("../config/config.php"); // Conexão com o banco de dados

// Certifique-se de que a conexão está funcionando
if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Consulta clientes ativos
$query = "SELECT id_cliente, nome, email FROM clientes WHERE ativo = 'true'";
$result = mysqli_query($conexao, $query);

if (!$result) {
    die("Erro na consulta ao banco de dados: " . mysqli_error($conexao));
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Clientes</title>
    <link rel="stylesheet" href="style/listar.css">
</head>
<body>
    <div class="container">
        <h2>Listar Clientes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($cliente = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($cliente['id_cliente']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['email']) . "</td>";
                        echo "<td><a href='./deletar.php?id_cliente=" . $cliente['id_cliente'] . "' onclick='return confirm(\"Tem certeza que deseja desativar este cliente?\")'>Desativar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum cliente ativo encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="../index.php" class="voltar">Voltar</a>
    </div>
</body>
</html>