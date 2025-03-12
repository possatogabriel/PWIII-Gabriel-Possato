<html>
<head>
    <title> Exercício 3 </title>
</head>
<body>
    <form action = "./Exercício3.php" method = "POST">
        <h1> Calcule 5% e 50% de um valor </h1>
        <input type = "number" name = "valor" placeholder = "Digite o valor"> <br>
        <input type = "submit" name = "enviar" value = "Enviar">

      <?php

          if(isset($_POST['enviar'])){
            $valor = $_POST['valor'];

            $valor5 = $valor * 0.05;
            $valor50 = $valor * 0.5; 
            echo "<p> 5% DO VALOR: $valor5 </p>";
            echo "<p> 50% DO VALOR: $valor50 </p>";
          }
        ?>

      </form>
</body>
</html>