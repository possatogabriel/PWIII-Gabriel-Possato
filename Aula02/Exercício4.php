<html>
  <head>
    <title> Exercicio 3 </title>
  </head>
  <body>
      <form action = "./Exercício4.php" method = "POST">
        <h1> Descubra o consumo médio de um carro </h1>
        <input type = "number" name = "km" placeholder = "Digite a distância"> <br>
        <input type = "number" name = "litros" placeholder = "Digite o combustível total"> <br>
        <input type = "submit" name = "enviar" value = "Enviar">

      <?php

          if(isset($_POST['enviar'])){
            $distancia = $_POST['km'];
            $combustivel = $_POST['litros'];

            $consumoMedio = $distancia / $combustivel;
            echo "<p> CONSUMO MÉDIO DO CARRO: $consumoMedio km/l </p>";
          }
        ?>

      </form>
  </body>
</html>