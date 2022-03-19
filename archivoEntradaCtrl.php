<?php
class archivoEntradaCtrl{
    private $m1, $m2, $n;
    private $primeraInstruccion;
    private $segundaInstruccion;
    private $mensaje;

    public function leeArchivo($nombreArchivo){
	    $arrayLineas = file($nombreArchivo);
	    if($this->validaLineas($arrayLineas)){
            //echo "<br>Validado correcto";
            $bean = new challenge1Bean();
            $bean->primeraInstruccion = $this->primeraInstruccion;
            $bean->segundaInstruccion = $this->segundaInstruccion;
            $bean->mensaje = $this->mensaje;
            return $bean;
	    }
    }

    private function validaLineas($arrayLineas){
        $validadasLineas = $this->validaPrimerLineaEntrada(trim($arrayLineas[0]));

	    if($validadasLineas){
		    echo "<br>todo bien con la línea uno";
	    }
        $validadasLineas = $validadasLineas && $this->validaSegundaLineaEntrada(trim($arrayLineas[1]));

	    if($validadasLineas){
		    echo "<br>todo bien con la línea dos";
	    }

        $validadasLineas = $validadasLineas && $this->validaTerceraLineaEntrada(trim($arrayLineas[2]));

	    if($validadasLineas){
		    echo "<br>todo bien con la línea tres";
	    }

        $validadasLineas = $validadasLineas && $this->validaCuartaLineaEntrada(trim($arrayLineas[3]));

	    if(validadasLineas){
		    echo "<br>todo bien con la línea cuatro";
	    }
        return $validadasLineas;
    }

    private function validaPrimerLineaEntrada($lineaUno){
	    $limiteInferiorM = 2;
	    $limiteSuperiorM = 50;
	    $limiteInferiorN = 3;
	    $limiteSuperiorN = 5000;
        $numeroElementosEnLinea = 3;
	    
	    $arrayElementosLineaUno = explode(" ", $lineaUno);
	    echo "Elementos en linea uno: " . count($arrayElementosLineaUno);

	    if(count($arrayElementosLineaUno)!=$numeroElementosEnLinea){
		    throw new Exception('Elementos de linea uno no coinciden con especificación');
	    }

        if (preg_match('/[^0-9]/', $arrayElementosLineaUno[0])){
            throw new Exception('EL elemento m1 no es una cadena de números');
        }

	    $m1 = (int)$arrayElementosLineaUno[0];

        if (preg_match('/[^0-9]/', $arrayElementosLineaUno[1])){
            throw new Exception('EL elemento m2 no es una cadena de números');
        }
	    $m2 = (int)$arrayElementosLineaUno[1];

        if (preg_match('/[^0-9]/', $arrayElementosLineaUno[2])){
            throw new Exception('EL elemento n no es una cadena de números');
        }
	    $n = (int)$arrayElementosLineaUno[2];
	    
	    if($n<$limiteInferiorN || $n>$limiteSuperiorN){
		    throw new Exception('El elemento n no está dentro de los límites');
	    }
	    
	    if($m1<$limiteInferiorM || $m1>$limiteSuperiorM){
		    throw new Exception('El elemento m1 no está dentro de los límites de la aplicación');
	    }
	    if($m2<$limiteInferiorM || $m2>$limiteSuperiorM){
		    throw new Exception('El elemento m2 no está dentro de los límites de la aplicación');
	    }
	    
        $this->m1 = $m1;
        $this->m2 = $m2;
        $this->n = $n;
	    return true;
    }

    private function validaSegundaLineaEntrada($lineaDos){
        echo "<br>Tamaño de linea dos [$lineaDos]: " . strlen($lineaDos) . ", m1: " .$this->m1;
        if(strlen($lineaDos) <> $this->m1){
            throw new Exception('El tamaño de linea dos no coincide con el tamaño indicado en m1');
        }
        $this->primeraInstruccion = $lineaDos;
        return true;
    }

    private function validaTerceraLineaEntrada($lineaTres){
        echo "<br>Tamaño de linea tres [$lineaTres]: " . strlen($lineaTres) . ", m2: " .$this->m2;
        if(strlen($lineaTres) <> $this->m2){
            throw new Exception('El tamaño de linea tres no coincide con el tamaño indicado en m2');
        }
        $this->segundaInstruccion = $lineaTres;
        return true;
    }

    private function validaCuartaLineaEntrada($lineaCuatro){
        echo "<br>Tamaño de linea cuatro [$lineaCuatro]: " . strlen($lineaCuatro) . ", n: " .$this->n;
        if(strlen($lineaCuatro) <> $this->n){
            throw new Exception('El tamaño de linea cuatro no coincide con el tamaño indicado en n');
        }
        $this->mensaje = $lineaCuatro;
        return true;
    }
}
