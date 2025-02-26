<?php

$peso = 60;
$altura = 1.7;

$imc = $peso / ($altura * $altura);

echo "PESO: $peso </br>";
echo "ALTURA: $altura </br>"; 
echo "</br>";

if ($imc < 18.5) {
    echo "BAIXO PESO (VALOR DO IMC: $imc)";
} else if ($imc >= 18.5 && $imc <= 24.9) {
    echo "PESO NORMAL (VALOR DO IMC: $imc)";
} else if ($imc >= 25 && $imc <= 29.9) {
    echo "EXCESSO DE PESO (VALOR DO IMC: $imc)";
} else if ($imc >= 30 && $imc <= 34.9) {
    echo "OBESIDADE NÍVEL 1 (VALOR DO IMC: $imc)";
} else if ($imc > 35) {
    echo "OBESIDADE MÓRBIDA (VALOR DO IMC: $imc)";
} else {
    echo "Houve um erro, tente novamente!";
}
?>