<?php
include_once("config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $seguro = isset($_POST['seguro']) ? true : false; 

    $modelo = mysqli_real_escape_string($conexao, $_POST['modelo']);
    $ano = mysqli_real_escape_string($conexao, $_POST['ano']);
    $placa = mysqli_real_escape_string($conexao, $_POST['placa']);
    $cor = mysqli_real_escape_string($conexao, $_POST['cor']);
    $seguro = mysqli_real_escape_string($conexao, $_POST['seguro']);
    $valor = mysqli_real_escape_string($conexao, $_POST['valor']);
    $documento = mysqli_real_escape_string($conexao, $_POST['documento']);
    $ocorrencia = mysqli_real_escape_string($conexao, $_POST['ocorrencia']);
    $bloqueio = mysqli_real_escape_string($conexao, $_POST['bloqueio']);
    $data_cadastro = date('Y-m-d H:i:s');

    $verifica = "SELECT id FROM carros WHERE placa = '$placa'";
    $resultado = mysqli_query($conexao, $verifica);

    if (mysqli_num_rows($resultado) > 0) {
        header("Location: cadastrar.php?erro=placa");
        exit;
    } else {
        $query = "INSERT INTO carros (modelo, ano, placa, cor, seguro, valor, documento, ocorrencia, bloqueio, data_cadastro)
                  VALUES ('$modelo', '$ano', '$placa', '$cor', '$seguro', '$valor', '$documento', '$ocorrencia', '$bloqueio', '$data_cadastro')";

        if (mysqli_query($conexao, $query)) {
            header("Location: cadastrar.php?sucesso=1");
            exit;
        } else {
            header("Location: cadastrar.php?erro=bd");
            exit;
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
    <title>Webcar</title>
</head>
<body>
    <div class = "container">
        <div class = "texts"> 
            <p id = "dataAtual"> </p>
            <h1> Tela de Cadastro </h1> 
        </div>

        <?php if (isset($_GET['sucesso'])): ?>
            <div class="mensagem sucesso">
                Cadastro realizado com sucesso! Vá para <a href="consultar.php">tela de consulta</a>!
            </div>

        <?php elseif (isset($_GET['erro'])): ?>
            <div class="mensagem erro">
                <?php
                    if ($_GET['erro'] == 'placa') {
                        echo "Erro: Esta placa já está cadastrada.";
                    } elseif ($_GET['erro'] == 'bd') {
                        echo "Erro ao cadastrar. Tente novamente.";
                    }
                ?>
            </div>
        <?php endif ?>

        <form method = "POST" action = "cadastrar.php">
            <div class = "linha"> 
                <label for = "modelo"> Modelo: </label>
                <input type = "text" id = "modelo" name = "modelo" maxlength="30" required>
            </div>

            <div class = "linha"> 
                <label for = "ano"> Ano: </label>
                <input type = "number" id = "ano" name = "ano" min="1000" max="9999" required>
            </div>

            <div class = "linha"> 
                <label for = "placa"> Placa: </label>
                <input type = "text" id = "placa" name = "placa" minlength="10" maxlength="10" required>
            </div>

            <div class = "linha"> 
                <label for = "cor"> Cor: </label>
                <input type = "text" id = "cor" name = "cor" maxlength="15" required>
            </div>
 
            <div class = "linha esquerda"> 
                <label for = "seguro"> Seguro: </label>
                <input type = "checkbox" id = "seguro" name = "seguro">
            </div>

            <div class = "linha"> 
                <label for = "valor"> Valor: </label>
                <input type = "number" id = "valor" name = "valor" min="0" max="9999999999" required>
            </div>

            <div class = "linha"> 
                <label for = "documento"> Documento: </label>
                <input type = "number" id = "documento" name = "documento" min="0" max="99" required>
            </div>

            <div class = "linha"> 
                <label for = "ocorrencia"> Ocorrência: </label>
                <select name = "ocorrencia" id = "ocorrencia" required>
                    <option value = "1"> Nenhuma </option>
                    <option value = "2"> Colisão LEVE </option> 
                    <option value = "3"> Colisão MÉDIA </option>
                    <option value = "4"> Colisão GRAVE </option> 
                    <option value = "5"> Roubo SEM recuperação </option>
                    <option value = "6"> Roubo COM recuperação </option> 
                    <option value = "7"> Desastre natural COM recuperação </option>
                    <option value = "8"> Desastre natural SEM recuperação </option> 
                </select>
            </div>

            <div class = "linha"> 
                <label for = "bloqueio"> Bloqueio: </label>
                <input type = "number" id = "bloqueio" name = "bloqueio" min="0" max="1" required>
            </div>

            <input type = "submit" value = "Cadastrar">
            <a href = "../Aula06" class = "voltar"> Voltar </a>
        </form>
    </div>
    <script src = "js/script.js"> </script>
</body>
</html>