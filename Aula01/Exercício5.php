<html>
<head>
    <title> Exercício 5 </title>
</head>
<body>
    <form action = "./Exercício5.php" method = "POST">
        <h1> Calcule o IMC </h1>
        <input type = "number" name = "peso" placeholder = "Digite seu peso (kg)"> <br>
        <input type = "number" name = "altura" placeholder = "Digite sua altura (cm)"> <br>
        <input type = "submit" name = "enviar" value = "Enviar">

      <?php

          if(isset($_POST['enviar'])){
            $altura = $_POST['altura']/100;
            $peso = $_POST['peso'];

            $imc = $peso / ($altura * $altura);
            $imc = round($imc, 2);
            
            if ($imc < 18.5) {
                echo "<p> BAIXO PESO (VALOR DO IMC: $imc) </p>";
            } else if ($imc >= 18.5 && $imc <= 24.9) {
                echo "<p> PESO NORMAL (VALOR DO IMC: $imc) </p>";
            } else if ($imc >= 25 && $imc <= 29.9) {
                echo "<p> EXCESSO DE PESO (VALOR DO IMC: $imc) </p>";
            } else if ($imc >= 30 && $imc <= 34.9) {
                echo "<p> OBESIDADE NÍVEL 1 (VALOR DO IMC: $imc) </p>";
            } else if ($imc > 35) {
                echo "<p> OBESIDADE MÓRBIDA (VALOR DO IMC: $imc) </p>";
            } else {
                echo "<p> Houve um erro, tente novamente! </p>";
            }
          }
        ?>

      </form>
</body>
</html>