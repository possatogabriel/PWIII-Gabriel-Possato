<html>
  <head>
    <title> Exercicio 2 </title>
  </head>
  <body>
      <form action = "./Exercício2.php" method = "POST">
        <h1> Descubra o desconto de 27% de um valor </h1>
        <input type = "number" name = "valor" placeholder = "Digite o valor"> <br>
        <input type = "submit" name = "enviar" value = "Enviar">

      <?php

          if(isset($_POST['enviar'])){
            $valor = $_POST["valor"];

            $valorComDesconto = $valor - ($valor * 0.27);
            echo "<p> VALOR COM 27% DE DESCONTO: R$ $valorComDesconto </p>";
          }
        ?>

      </form>
  </body>
</html>