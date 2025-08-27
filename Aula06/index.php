<?php
include_once("config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = mysqli_real_escape_string($conexao, $_POST['modelo']);
    $ano = mysqli_real_escape_string($conexao, $_POST['ano']);
    $placa = mysqli_real_escape_string($conexao, $_POST['placa']);
    $cor = mysqli_real_escape_string($conexao, $_POST['cor']);
    $valor = mysqli_real_escape_string($conexao, $_POST['valor']);
    $data_cadastro = date('Y-m-d H:i:s');

    $verifica = "SELECT id FROM carros WHERE placa = '$placa'";
    $resultado = mysqli_query($conexao, $verifica);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<script>alert('Erro: Esta placa já está cadastrada.'); window.location.href='index.php';</script>";
    } else {
        $query = "INSERT INTO carros (modelo, ano, placa, cor, valor, data_cadastro) 
                  VALUES ('$modelo', '$ano', '$placa', '$cor', '$valor', '$data_cadastro')";

        if (mysqli_query($conexao, $query)) {
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='listar.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar: " . mysqli_error($conexao) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Veículo</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <div class="container">
        <p id="data-atual" class="data-atual"></p>
        <h2>Cadastrar Veículo</h2>
        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" maxlength="30" required>
            </div>

            <div class="form-group">
                <label for="ano">Ano:</label>
                <input type="text" id="ano" name="ano" minlength="4" maxlength="4" required>
            </div>

            <div class="form-group">
                <label for="placa">Placa:</label>
                <input type="text" id="placa" name="placa" minlength="10" maxlength="10" required>
            </div>

            <div class="form-group">
                <label for="cor">Cor:</label>
                <input type="text" id="cor" name="cor" maxlength="15" required>
            </div>

            <div class="form-group">
                <label for="valor">Valor:</label>
                <input type="text" id="valor" name="valor" maxlength="10" required>
            </div>
            <input type="submit" value="Cadastrar">
        </form>

    <div class="color-picker">
        <label for="foreground">Cor do tema (textos e botão):</label>
        <input type="color" id="foreground" name="foreground" value="#e66465" />
    </div>

    <div class="color-picker">
        <label for="background">Cor de fundo:</label>
        <input type="color" id="background" name="background" value="#121212" />
    </div>

    <div class="color-picker">
        <label for="containerColor">Cor do container:</label>
        <input type="color" id="containerColor" name="containerColor" value="#1e1e1e" />
    </div>

    <script src="js/tema.js"></script>
</body>
</html>
