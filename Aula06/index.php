<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "CSS/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Webcar</title>
</head>
<body>
    <header> 
        <h1> WEBCAR </h1>
        
        <div class = "cabecalho"> 
            <nav> 
                <ul>
                    <li> <a href="?pagina=apresentacao"> Apresentação </a> </li>
                    <li> <a href="?pagina=funcionamento"> Funcionamento </a> </li>
                    <li> <a href="?pagina=suporte"> Suporte </a> </li>
                </ul>
            </nav>

            <a href = "login.php" class = "login"> Login </a>
        </div>
    </header>

    <main> 
        <div class = "container">
            <div class = "background-text">

            <?php
                if (isset($_GET['pagina'])) {
                    $pagina = $_GET['pagina'];

                    switch ($pagina) {
                        case 'apresentacao':
                            echo "<p>Um sistema web é um software hospedado na internet que pode ser acessado a qualquer momento e lugar através de um navegador (como Chrome, Firefox, etc.), em qualquer dispositivo com conexão à internet...</p>";
                            break;
                        case 'funcionamento':
                            echo "<p>O funcionamento do sistema é baseado em uma arquitetura cliente-servidor, onde o cliente faz requisições e o servidor responde com os dados necessários.</p>";
                            break;
                        case 'suporte':
                            echo "<p>Para suporte, entre em contato com nossa equipe através do e-mail suporte@webcar.com.</p>";
                            break;
                        default:
                            echo "<p>Selecione uma opção no menu para ver mais informações.</p>";
                            break;
                    }
                } else {
                    echo "<p>Selecione uma opção no menu para ver mais informações.</p>";
                }
                ?>

            </div>
        </div>
    </main>

    <footer>
        <nav>
            <ul>
                <li> <a href = "?"> Contato </a> </li>
                <li> <a href = "?"> Redes </a> </li>
                <li> <a href = "?"> Selos </a> </li>
                <li> <a href = "?"> Colaboradores </a> </li>
            </ul>
        </nav>
    </footer>

    <script src = "JS/script.js"> </script>
</body>
</html>