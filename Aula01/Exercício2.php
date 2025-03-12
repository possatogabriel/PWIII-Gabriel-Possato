<html>
  <head>
    <title> Exercicio 2 </title>
  </head>
  <body>
      <form action = "./Exercício2.php" method = "POST">
        <h1> Calcule 15% de um valor </h1>
        <input type = "number" name = "valor" placeholder = "Digite o valor"> <br>
        <input type = "submit" name = "enviar" value = "Enviar">

      <?php

          if(isset($_POST['enviar'])){
            $valor = $_POST['valor'];

            $valorFinal = $valor * 0.15; 
            echo "<p> 15% DO VALOR: $valorFinal </p>";
          }
        ?>

      </form>
  </body>
</html>