<?php

$valor = 100;

$porcentagem = $valor * 0.16;

$valorFinal = $valor + $porcentagem;
$valorParcela = $valorFinal / 10;

echo "VALOR: $valor </br>";
echo "</br>";
echo "VALOR FINAL: $valorFinal </br>";
echo "</br>";
echo "VALOR PARCELADO: $valorParcela";
?>