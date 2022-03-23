<?php
class procesaDatosBeanCtrl{
    /**
     * Limpia la cadena con el mensaje de los caracteres repetidos
     * @param String $mensaje El mensaje obtenido del archivo de entrada
     * @return string La cadena del mensaje sin caracteres repetidos
     */
    public static function eliminaCaracteresRepetido($mensaje){
        $cadenaSinRepeticiones = ''; 
        $caracterActual = ''; 
        $caracterSinRepetir = '';
        $unSoloCaracter = 1;
        $tamanioCadenaMensaje = strlen($mensaje);

        for($i = 0;$i<$tamanioCadenaMensaje;$i++){
            $caracterActual = substr($mensaje, $i, $unSoloCaracter);

            if($caracterActual != $caracterSinRepetir){
                $cadenaSinRepeticiones = $cadenaSinRepeticiones . $caracterSinRepetir;
                $caracterSinRepetir = $caracterActual;
            }

        }
        if($caracterActual != $caracterSinRepetir){
            $cadenaSinRepeticiones = $cadenaSinRepeticiones . $caracterSinRepetir;
            $caracterSinRepetir = $caracterActual;
        }
        return $cadenaSinRepeticiones;
    }
    
    /**
     * Busca la instrucción en el mensaje
     * @param string $instruccion la instrucción a buscar en el mensaje
     * @param string $mensaje El mensaje donde se buscará la instrucción
     * @return string SI se se encontró la instrucción en el mensaje o NO si lo contrario 
     */
    public static function seEncuentraLaInstruccionEnElMensaje($instruccion, $mensaje){
        $pos = strpos($mensaje, $instruccion);
        return ($pos === false)?'NO':'SI';
    }
}
