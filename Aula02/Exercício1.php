<html>
  <head>
    <title> Exercicio 1 </title>
  </head>
  <body>
      <form action = "./Exercício1.php" method = "POST">
        <h1> Descubra o volume de uma caixa retangular </h1>
        <input type = "number" name = "comprimento" placeholder = "Digite o comprimento"> <br>
        <input type = "number" name = "largura" placeholder = "Digite a largura"> <br>
        <input type = "number" name = "altura" placeholder = "Digite a altura"> <br>
        <input type = "submit" name = "enviar" value = "Enviar">

      <?php

          if(isset($_POST['enviar'])){
            $comprimento = $_POST["comprimento"];
            $largura = $_POST["largura"];
            $altura = $_POST["altura"];

            $volume = $comprimento * $largura * $altura;
            echo "<p> VOLUME DA CAIXA: $volume </p>";
          }
        ?>

      </form>
  </body>
</html>