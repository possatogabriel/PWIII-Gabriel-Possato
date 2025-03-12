<html>
<head>
    <title> Exercício 4 </title>
</head>
<body>
    <form action = "./Exercício4.php" method = "POST">
        <h1> Calcule a soma dos quadrados de dois números </h1>
        <input type = "number" name = "valor1" placeholder = "Digite o valor 1"> <br>
        <input type = "number" name = "valor2" placeholder = "Digite o valor 2"> <br>
        <input type = "submit" name = "enviar" value = "Enviar">

      <?php

          if(isset($_POST['enviar'])){
            $valor1 = $_POST['valor1'];
            $valor2 = $_POST['valor2'];

            $valorTotal = ($valor1 * $valor1) + ($valor2 * $valor2);
            echo "<p> SOMA DOS QUADRADOS: $valorTotal </p>";
          }
        ?>

      </form>
</body>
</html>