<html>
  <head>
    <title> Exercicio 3 </title>
  </head>
  <body>
      <form action = "./Exercício3.php" method = "POST">
        <h1> Descubra um valor 16% mais caro e parcelado </h1>
        <input type = "number" name = "valor" placeholder = "Digite o valor"> <br>
        <input type = "submit" name = "enviar" value = "Enviar">

      <?php

          if(isset($_POST['enviar'])){
            $valor = $_POST["valor"];

            $valorTotal = $valor + ($valor * 0.16);
            $valorParcelas = $valorTotal / 10;
            echo "<p> VALOR TOTAL: R$ $valorTotal </p>";
            echo "<p> VALOR DAS PARCELAS (10x): R$ $valorParcelas </p>";
          }
        ?>

      </form>
  </body>
</html>