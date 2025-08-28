<?php



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "CSS/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Tela Inicial</title>
</head>
<body>
    <div class = "container">
        <div class = "texts"> 
            <p id = "dataAtual"> </p>
            <h1> Tela Inicial </h1> 
        </div>

        <div class = "buttons"> 
            <a href = "cadastro.php"> Fazer cadastro </a>
            <a href = "consulta.php"> Ver consulta </a> 
            
                <div class = "cores">
                    <div class = "linha"> 
                        <p> Alterar cor do texto e botões: </p>
                        <input type = "color" id = "corTexto" value="#ffffff">
                    </div>
                    
                    <div class = "linha"> 
                        <p> Alterar cor do fundo: </p>
                        <input type = "color" id = "corFundo" value="#000000">
                    </div>
                </div>
        </div>
    </div>
    <script src = "js/script.js"> </script>
</body>
</html>