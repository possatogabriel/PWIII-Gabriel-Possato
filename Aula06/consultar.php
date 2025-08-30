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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "CSS/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Consulta</title>
</head>
<body>
    <div class = "container">
        <div class = "texts"> 
            <p id = "dataAtual"> </p>
            <h1> Tela de Consulta </h1> 
        </div>

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

        <a href = "index.html" class = "voltar"> Voltar </a>
    </div>

    <script src = "js/script.js"> </script>
</body>
</html>