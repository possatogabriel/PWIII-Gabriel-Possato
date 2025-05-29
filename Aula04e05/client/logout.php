<?php
// Remove o cookie de login
setcookie("login", "", time() - 3600, "/");

// Redireciona para a página de login
header("Location: ../admin/login.php");
exit();
?>
