<?php
include_once("config/config.php"); // Conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $modelo = mysqli_real_escape_string($conexao, $_POST['modelo']);
    $ano = mysqli_real_escape_string($conexao, $_POST['ano']);
    $placa = mysqli_real_escape_string($conexao, $_POST['placa']);
    $data_cadastro = date('Y-m-d H:i:s'); // Data e hora atual

    // Verifica se a placa já existe
    $verifica = "SELECT id FROM carros WHERE placa = '$placa'";
    $resultado = mysqli_query($conexao, $verifica);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<script>alert('Erro: Esta placa já está cadastrada.'); window.location.href='index.php';</script>";
    } else {
        // Monta a query de inserção
        $query = "INSERT INTO carros (modelo, ano, placa, data_cadastro) 
                  VALUES ('$modelo', '$ano', '$placa', '$data_cadastro')";

        // Executa a query
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
    <link rel="stylesheet" href="style/criar.css">
</head>
<body>
    <div class="container">
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
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>
