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
        echo "<script>alert('Erro: Esta placa já está cadastrada.'); window.location.href='cadastrar.php';</script>";
    } else {
        $query = "INSERT INTO carros (modelo, ano, placa, cor, valor, data_cadastro) 
                  VALUES ('$modelo', '$ano', '$placa', '$cor', '$valor', '$data_cadastro')";

        if (mysqli_query($conexao, $query)) {
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='consultar.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar: " . mysqli_error($conexao) . "');</script>";
        }
    }
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
    <title>Cadastro</title>
</head>
<body>
    <div class = "container">
        <div class = "texts"> 
            <p id = "dataAtual"> </p>
            <h1> Tela de Cadastro </h1> 
        </div>

        <form method = "POST" action = "cadastrar.php">
            <div class = "linha"> 
                <label for = "modelo"> Modelo: </label>
                <input type = "text" id = "modelo" name = "modelo" maxlength="30" required>
            </div>

            <div class = "linha"> 
                <label for = "ano"> Ano: </label>
                <input type = "text" id = "ano" name = "ano" minlength="4" maxlength="4" required>
            </div>

            <div class = "linha"> 
                <label for = "placa"> Placa: </label>
                <input type = "text" id = "placa" name = "placa" minlength="10" maxlength="10" required>
            </div>

            <div class = "linha"> 
                <label for = "cor"> Cor: </label>
                <input type = "text" id = "cor" name = "cor" maxlength="15" required>
            </div>

            <div class = "linha"> 
                <label for = "valor"> Valor: </label>
                <input type = "text" id = "valor" name = "valor" maxlength="10" required>
            </div>

            <input type = "submit" value = "Cadastrar">
            <a href = "index.html" class = "voltar"> Voltar </a>
        </form>
    </div>
    <script src = "js/script.js"> </script>
</body>
</html>