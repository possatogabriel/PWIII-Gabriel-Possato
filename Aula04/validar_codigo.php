<?php
session_start(); // Iniciar a sessão para acessar o código armazenado

if (isset($_POST['validar_codigo'])) {
    $codigo_informado = $_POST['codigo'];

    // Verificar se o código informado corresponde ao código gerado
    if ($codigo_informado == $_SESSION['codigo_recuperacao']) {
        echo "Código válido! Você pode redefinir sua senha.<br>";
        echo "<a href='redefinir_senha.php'>Clique aqui para redefinir sua senha.</a>";
        // Aqui, você pode redirecionar para uma página de redefinição de senha ou continuar o processo
    } else {
        echo "Código inválido! Tente novamente.<br>";
        echo "<a href='recuperacao.php'>Voltar para a página de recuperação.</a>";
    }
} else {
    echo "Nenhum código foi enviado para validação.<br>";
    echo "<a href='recuperacao.php'>Voltar para a página de recuperação.</a>";
}
?>
