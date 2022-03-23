<?php

/**
 * Clase con el control de apertura y validación del archivo de entrada.
 */
class archivoEntradaCtrl {

    private $m1;
    private $m2;
    private $n;
    private $primeraInstruccion;
    private $segundaInstruccion;
    private $mensaje;

    /**
     * Lunción que lee el archivo y llena el bean con los datos del archivo cuando se ha validado el archivo.
     * @param String $nombreArchivo La ruta al archivo de entrada
     * @return \challenge1Bean 
     */
    public function leeArchivo($nombreArchivo) {
        $arrayLineas = file($nombreArchivo);
        try {
            if ($this->validaLineas($arrayLineas)) {
                $bean = new challenge1Bean();
                $bean->primeraInstruccion = $this->primeraInstruccion;
                $bean->segundaInstruccion = $this->segundaInstruccion;
                $bean->mensaje = $this->mensaje;
                return $bean;
            }
        } catch (MyException $e) {
            throw $e;
        }
    }

    /**
     * Aplica las reglas de validación de las líneas al array de cadenas del archivo
     * @param Array $arrayLineas Un array con las líneas del archivo de entrada
     * @return Boolean Con las validaciones por línea acumuladas.
     */
    private function validaLineas($arrayLineas) {
        $numeroDeLineasEnElArchivo = 4;
        try {
            
            if(count($arrayLineas) <> $numeroDeLineasEnElArchivo){
                throw new Exception('El archivo no cuenta con las líneas requeridas, deben de ser 4 y hay ' . count($arrayLineas));
            }
            $validadasLineas = $this->validaPrimerLineaEntrada(trim($arrayLineas[0]));
            $validadasLineas = $validadasLineas && $this->validaSegundaLineaEntrada(trim($arrayLineas[1]));
            $validadasLineas = $validadasLineas && $this->validaTerceraLineaEntrada(trim($arrayLineas[2]));
            $validadasLineas = $validadasLineas && $this->validaCuartaLineaEntrada(trim($arrayLineas[3]));
        } catch (MyException $e) {
            throw $e;
        }
        return $validadasLineas;
    }

    /**
     * Valida y en caso de terminar de manera correcta asigna los valores de la linea 1 a las propiedades de la clase.
     * @param String $lineaUno el valor encontrado en la primer línea del archivo de inicio.
     * @return boolean El valor de si pasó las validaciones del archivo.
     * @throws Exception
     */
    private function validaPrimerLineaEntrada($lineaUno) {
        $limiteInferiorM = 2;
        $limiteSuperiorM = 50;
        $limiteInferiorN = 3;
        $limiteSuperiorN = 5000;
        $numeroElementosEnLinea = 3;

        $arrayElementosLineaUno = explode(" ", $lineaUno);

        if (count($arrayElementosLineaUno) <> $numeroElementosEnLinea) {
            throw new Exception('Elementos de linea uno no coinciden con especificación, deben ser tres y hay '.count($arrayElementosLineaUno));
        }

        if (preg_match('/[^0-9]/', $arrayElementosLineaUno[0])) {
            throw new Exception('EL elemento m1 no es una cadena de números');
        }

        $m1 = (int) $arrayElementosLineaUno[0];

        if (preg_match('/[^0-9]/', $arrayElementosLineaUno[1])) {
            throw new Exception('EL elemento m2 no es una cadena de números');
        }
        $m2 = (int) $arrayElementosLineaUno[1];

        if (preg_match('/[^0-9]/', $arrayElementosLineaUno[2])) {
            throw new Exception('EL elemento n no es una cadena de números');
        }
        $n = (int) $arrayElementosLineaUno[2];

        if ($n < $limiteInferiorN || $n > $limiteSuperiorN) {
            throw new Exception('El elemento n no está dentro de los límites');
        }

        if ($m1 < $limiteInferiorM || $m1 > $limiteSuperiorM) {
            throw new Exception('El elemento m1 no está dentro de los límites de la aplicación');
        }
        if ($m2 < $limiteInferiorM || $m2 > $limiteSuperiorM) {
            throw new Exception('El elemento m2 no está dentro de los límites de la aplicación');
        }

        $this->m1 = $m1;
        $this->m2 = $m2;
        $this->n = $n;
        
        return true;
    }

    /**
     * Valida los datos de la lines dos del archivo, así como asigna el contenido a propiedad del objeto
     * @param String $lineaDos La cadena de la linea dos el archivo
     * @return boolean
     * @throws Exception
     */
    private function validaSegundaLineaEntrada($lineaDos) {
        if (strlen($lineaDos) <> $this->m1) {
            throw new Exception('El tamaño de linea dos no coincide con el tamaño indicado en m1');
        }
        $this->primeraInstruccion = $lineaDos;
        return true;
    }

    /**
     * Valida los datos de la línea tres del archivo, así como asigna el contenido a propiedad del objeto
     * @param String $lineaTres La cadena de la línea tres del archivo.
     * @return boolean
     * @throws Exception
     */
    private function validaTerceraLineaEntrada($lineaTres) {
        if (strlen($lineaTres) <> $this->m2) {
            throw new Exception('El tamaño de linea tres no coincide con el tamaño indicado en m2');
        }
        $this->segundaInstruccion = $lineaTres;
        return true;
    }

    /**
     * Valida los datos de la línea tres del archivo, así como asigna el contenido a propiedad del objeto
     * @param type $lineaCuatro
     * @return boolean
     * @throws Exception
     */
    private function validaCuartaLineaEntrada($lineaCuatro) {
        if (strlen($lineaCuatro) <> $this->n) {
            throw new Exception('El tamaño de linea cuatro no coincide con el tamaño indicado en n');
        }

        if (!preg_match("[^\w\*]", $lineaCuatro)) {
            throw new Exception('La cuarta línea no cumple con los requerimientos de caracteres');
        }
        $this->mensaje = $lineaCuatro;
        return true;
    }

}
