<?php
include_once("config/config.php");

$dados = null;
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id         = $_POST["id"];
    $modelo     = mysqli_real_escape_string($conexao, $_POST["modelo"]);
    $ano        = mysqli_real_escape_string($conexao, $_POST["ano"]);
    $placa      = mysqli_real_escape_string($conexao, $_POST["placa"]);
    $cor        = mysqli_real_escape_string($conexao, $_POST["cor"]);
    $seguro        = mysqli_real_escape_string($conexao, $_POST["seguro"]);
    $valor      = mysqli_real_escape_string($conexao, $_POST["valor"]);
    $documento  = mysqli_real_escape_string($conexao, $_POST["documento"]);
    $ocorrencia = mysqli_real_escape_string($conexao, $_POST["ocorrencia"]);
    $bloqueio   = mysqli_real_escape_string($conexao, $_POST["bloqueio"]);

    $sql_update = "UPDATE carros SET modelo = ?, ano = ?, placa = ?, cor = ?, seguro = ?, valor = ?, documento = ?, ocorrencia = ?, bloqueio = ? WHERE id = ?";
    $stmt_post = $conexao->prepare($sql_update);
    $stmt_post->bind_param("sisssiiiii", $modelo, $ano, $placa, $cor, $seguro, $valor, $documento, $ocorrencia, $bloqueio, $id);

    if ($stmt_post->execute()) {
        $mensagem = "<div class='mensagem sucesso'>Dados atualizados com sucesso!</div>";
    } else {
        $mensagem = "<div class='mensagem erro'>Erro ao atualizar: " . $stmt_post->error . "</div>";
    }

    $stmt_post->close();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["valorID"])) {
    $id = $_GET["valorID"];

    $sql_get = "SELECT * FROM carros WHERE id = ?";
    $stmt_get = $conexao->prepare($sql_get);
    $stmt_get->bind_param("i", $id);
    $stmt_get->execute();
    $resultado = $stmt_get->get_result();

    if ($resultado->num_rows > 0) {
    $dados = $resultado->fetch_assoc();

        if ($dados['bloqueio'] == 1) {
            $mensagem = "<div class='mensagem erro'>Este perfil está bloqueado e não pode ser editado.</div>";
            $dados = null; // Impede que o formulário apareça
        }
    } else {
    $mensagem = "<div class='mensagem erro'>ID não encontrado.</div>";
    }
    $stmt_get->close();
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="preconexaoect" href="https://fonts.googleapis.com">
    <link rel="preconexaoect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Webcar</title>
</head>
<body>
    <div class="container">
        <div class="texts">
            <p id="dataAtual"></p>
            <h1>Tela de Edição</h1>
        </div>

        <?= $mensagem ?>

        <?php if (!$dados): ?>
        <form method="GET" action="editar.php">
            <div class="linha">
                <label for="valorID">Insira o ID:</label>
                <input type="number" id="valorID" name="valorID" required>
            </div>
            <input type="submit" value="Buscar">
            <a href="../Aula06" class="voltar">Voltar</a>
        </form>
        <?php endif; ?>

        <?php if ($dados): ?>
        <form method="POST" action="editar.php">
            <input type="hidden" name="id" value="<?= $dados['id'] ?>">

            <div class="linha">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" value="<?= $dados['modelo'] ?>" maxlength="30" required>
            </div>

            <div class="linha">
                <label for="ano">Ano:</label>
                <input type="number" id="ano" name="ano" value="<?= $dados['ano'] ?>" min="1000" max="9999" required>
            </div>

            <div class="linha">
                <label for="placa">Placa:</label>
                <input type="text" id="placa" name="placa" value="<?= $dados['placa'] ?>" minlength="10" maxlength="10" required>
            </div>

            <div class="linha">
                <label for="cor">Cor:</label>
                <input type="text" id="cor" name="cor" value="<?= $dados['cor'] ?>" maxlength="15" required>
            </div>

            <div class="linha">
                <label for="valor">Valor:</label>
                <input type="number" id="valor" name="valor" value="<?= $dados['valor'] ?>" min="0" max="9999999999" required>
            </div>

            <div class = "linha esquerda"> 
                <label for = "seguro"> Seguro: </label>
                <input type = "checkbox" id = "seguro" name = "seguro" required>
            </div>

            <div class="linha">
                <label for="documento">Documento:</label>
                <input type="number" id="documento" name="documento" value="<?= $dados['documento'] ?>" min="0" max="99" required>
            </div>

            <div class="linha">
                <label for="ocorrencia">Ocorrência:</label>
                <select name="ocorrencia" id="ocorrencia" required>
                    <option value="1">Nenhuma</option>
                    <option value="2">Colisão LEVE</option>
                    <option value="3">Colisão MÉDIA</option>
                    <option value="4">Colisão GRAVE</option>
                    <option value="5">Roubo SEM recuperação</option>
                    <option value="6">Roubo COM recuperação</option>
                    <option value="7">Desastre natural COM recuperação</option>
                    <option value="8">Desastre natural SEM recuperação</option>
                </select>
            </div>

            <div class="linha">
                <label for="bloqueio">Bloqueio:</label>
                <input type="number" id="bloqueio" name="bloqueio" value="<?= $dados['bloqueio'] ?>" min="0" max="1" required>
            </div>

            <input type="submit" value="Atualizar">
            <a href="../Aula06" class="voltar">Voltar</a>
        </form>
        <?php endif; ?>
    </div>
    <script src="JS/script.js"></script>
</body>
</html>