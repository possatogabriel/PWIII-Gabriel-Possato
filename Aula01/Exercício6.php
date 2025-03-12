<html>
<head>
    <title> Exercício 6 </title>
</head>
<body>
    <form action = "./Exercício6.php" method = "POST">
        <h1> Calcule o desconto de um produto </h1>
        <input type = "number" name = "valor" placeholder = "Digite o valor"> <br>
        <input type = "submit" name = "enviar" value = "Enviar">

      <?php

          if(isset($_POST['enviar'])){
            $valor = $_POST['valor'];

            $desconto = $valor * 0.07;

            $valorComDesconto = $valor - $desconto;
            
            echo "<p> VALOR DO DESCONTO: R$ $desconto </p>";
            echo "<p> VALOR COM DESCONTO: R$ $valorComDesconto </p>";
          }
        ?>

      </form>
</body>
</html>