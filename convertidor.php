<?php

function validaPrimerLineaEntrada($lineaUno){
	$limiteInferiorM = 2;
	$limiteSuperiorM = 50;
	$limiteInferiorN = 3;
	$limiteSuperiorN = 5000;
	
	$arrayElementosLineaUno = explode(" ", $lineaUno);
	echo "Elementos en linea uno: " . count($arrayElementosLineaUno);
	if(count($arrayElementosLineaUno)!=3){
		throw new Exception('Elementos de linea uno no coinciden con especificación');
	}
	$m1 = $arrayElementosLineaUno[0];
	$m2 = $arrayElementosLineaUno[1];
	$n = $arrayElementosLineaUno[2];
	
	if($n<$limiteInferiorN || $n>$limiteSuperiorN){
		throw new Exception('El elemento n no está dentro de los límites');
	}
	
	if($m1<$limiteInferiorM || $m1>$limiteSuperiorM){
		throw new Exception('El elemento m1 no está dentro de los límites de la aplicación');
	}
	if($m2<$limiteInferiorM || $m2>$limiteSuperiorM){
		throw new Exception('El elemento m2 no está dentro de los límites de la aplicación');
	}
	
	return true;
}
function validaLineas($arrayLineas){
	if(validaPrimerLineaEntrada($arrayLineas[0])){
		echo "<br>todo bien con la línea uno";
	}
}


function leeArchivo($nombreArchivo){
	$arrayLineas = file($nombreArchivo);
	if(validaLineas($arrayLineas)){
		return $arrayLineas;
	}
}

function procesaArchivo($nombreArchivo){
	leeArchivo($nombreArchivo);
}

procesaArchivo("./entrada.txt");