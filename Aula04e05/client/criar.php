<?php
include_once("../config/config.php"); // Conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $email_recuperacao = mysqli_real_escape_string($conexao, $_POST['email_recuperacao']);
    $senha = $_POST['senha'];
    $nivel = intval($_POST['nivel']);
    $ativo = 'true';
    $data_hora_atual = date('Y-m-d H:i:s'); // Agora armazena data e hora

    // Definir corretamente o celular com base no nível do usuário
    $celular = "";
    if ($nivel == 1) {
        $celular = mysqli_real_escape_string($conexao, $_POST['celular_cliente']);
    } elseif ($nivel == 2) {
        $celular = mysqli_real_escape_string($conexao, $_POST['celular_vendedor']);
    }

    $endereco = isset($_POST['endereco']) ? mysqli_real_escape_string($conexao, $_POST['endereco']) : "";
    $bairro = isset($_POST['bairro']) ? mysqli_real_escape_string($conexao, $_POST['bairro']) : "";
    $cidade = isset($_POST['cidade']) ? mysqli_real_escape_string($conexao, $_POST['cidade']) : "";
    $uf = isset($_POST['uf']) ? mysqli_real_escape_string($conexao, $_POST['uf']) : "";
    $cep = isset($_POST['cep']) ? mysqli_real_escape_string($conexao, $_POST['cep']) : "";
    $atuacao = isset($_POST['atuacao']) ? mysqli_real_escape_string($conexao, $_POST['atuacao']) : "";
    $comissao = isset($_POST['comissao']) ? floatval($_POST['comissao']) : 0.00;

    // Validação do comprimento da senha
    if (strlen($senha) > 8) {
        echo "<script>alert('Erro: A senha deve ter no máximo 8 caracteres.');</script>";
    } else {
        // Criptografar a senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Cadastro na tabela `usuarios`
        $query_usuario = "INSERT INTO usuarios (nome, email, email_recup, senha, data_cad, data_alt, ativo, nivel) 
                          VALUES ('$nome', '$email', '$email_recuperacao', '$senha_hash', '$data_hora_atual', '$data_hora_atual', '$ativo', $nivel)";

        if (mysqli_query($conexao, $query_usuario)) {
            $id_usuario = mysqli_insert_id($conexao); // Obtém o ID gerado

            // Cadastro adicional na tabela correta
            if ($nivel == 1) {
                // Cadastro em `clientes` SEM `data_alt`
                $query_cliente = "INSERT INTO clientes (id_usuario, endereco, bairro, cidade, uf, cep, celular, usuario_cad, usuario_alt) 
                                  VALUES ('$id_usuario', '$endereco', '$bairro', '$cidade', '$uf', '$cep', '$celular', 'Admin', NULL)";
                mysqli_query($conexao, $query_cliente);
            } elseif ($nivel == 2) {
                // Cadastro em `vendedores`
                $query_vendedor = "INSERT INTO vendedores (id_usuario, celular, atuacao, comissao) 
                                   VALUES ('$id_usuario', '$celular', '$atuacao', '$comissao')";
                mysqli_query($conexao, $query_vendedor);
            }

            echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href='../index.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar usuário.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="style/criar.css">
    <script>
        function mostrarCampos() {
            let nivel = document.getElementById("nivel").value;
            document.getElementById("camposCliente").style.display = (nivel == 1) ? "block" : "none";
            document.getElementById("camposVendedor").style.display = (nivel == 2) ? "block" : "none";
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Cadastrar Usuário</h2>
        <form method="POST" action="./criar.php">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="email_recuperacao">E-mail de Recuperação:</label>
                <input type="email" id="email_recuperacao" name="email_recuperacao" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" maxlength="8" required>
            </div>

            <div class="form-group">
                <label for="nivel">Nível do Usuário:</label>
                <select id="nivel" name="nivel" required onchange="mostrarCampos()">
                    <option value="">Selecione...</option>
                    <option value="1">Cliente</option>
                    <option value="2">Vendedor</option>
                </select>
            </div>

            <!-- Campos específicos para Cliente -->
            <div id="camposCliente" style="display: none;">
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco">
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro:</label>
                    <input type="text" id="bairro" name="bairro">
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade:</label>
                    <input type="text" id="cidade" name="cidade">
                </div>
                <div class="form-group">
                    <label for="uf">UF:</label>
                    <input type="text" id="uf" name="uf" maxlength="2">
                </div>
                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" maxlength="8">
                </div>
                <div class="form-group">
                    <label for="celular_cliente">Celular:</label>
                    <input type="text" id="celular_cliente" name="celular_cliente" maxlength="9">
                </div>
            </div>

            <!-- Campos específicos para Vendedor -->
            <div id="camposVendedor" style="display: none;">
                <div class="form-group">
                    <label for="celular_vendedor">Celular:</label>
                    <input type="text" id="celular_vendedor" name="celular_vendedor" maxlength="9">
                </div>
                <div class="form-group">
                    <label for="atuacao">Atuação:</label>
                    <input type="text" id="atuacao" name="atuacao" maxlength="2">
                </div>
                <div class="form-group">
                    <label for="comissao">Comissão (%):</label>
                    <input type="number" id="comissao" name="comissao" step="0.01">
                </div>
            </div>
            <input type="submit" value="Cadastrar">
        </form>
        <a href="../index.php" class="voltar">Voltar</a>
    </div>
</body>
</html>