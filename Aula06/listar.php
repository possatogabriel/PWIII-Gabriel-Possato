<?php
include_once("config/config.php");

if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}

$query = "SELECT id, modelo, ano, placa, cor, valor, data_cadastro FROM carros ORDER BY data_cadastro DESC";
$result = mysqli_query($conexao, $query);

if (!$result) {
    die("Erro na consulta ao banco de dados: " . mysqli_error($conexao));
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Veículos Cadastrados</title>
    <link rel="stylesheet" href="style/listar.css">
</head>
<body>
    <div class="container">
        <p id="data-atual" class="data-atual"></p>
        <h2>Veículos Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                    <th>Placa</th>
                    <th>Cor</th>
                    <th>Valor</th>
                    <th>Data de Cadastro</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($usuario = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($usuario['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($usuario['modelo']) . "</td>";
                        echo "<td>" . htmlspecialchars($usuario['ano']) . "</td>";
                        echo "<td>" . htmlspecialchars($usuario['placa']) . "</td>";
                        echo "<td>" . htmlspecialchars($usuario['cor']) . "</td>";
                        echo "<td>" . htmlspecialchars($usuario['valor']) . "</td>";
                        echo "<td>" . htmlspecialchars(date('d/m/Y H:i', strtotime($usuario['data_cadastro']))) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhum veículo cadastrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="index.php" class="voltar">Voltar</a>
    </div>

    <script src="js/tema.js"></script>
</body>
</html>
