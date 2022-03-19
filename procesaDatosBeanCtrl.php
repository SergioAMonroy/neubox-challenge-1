<?php
class procesaDatosBeanCtrl{
    public static function eliminaCaracteresRepetidosEnMensaje($mensaje){
        $cadenaSinRepeticiones = ''; 
        $caracterActual = ''; 
        $caracterSinRepetir = '';
        $unSoloCaracter = 1;
        $tamanioCadenaMensaje = strlen($mensaje);

        //echo "Tamaño de la cadena del mensaje: " .$tamanioCadenaMensaje;

        for($i = 0;$i<$tamanioCadenaMensaje;$i++){
            $caracterActual = substr($mensaje, $i, $unSoloCaracter);
            //echo '<br>' . $caracterActual . '-' . $caracterSinRepetir;
            if($caracterActual != $caracterSinRepetir){
                $cadenaSinRepeticiones = $cadenaSinRepeticiones . $caracterSinRepetir;
                $caracterSinRepetir = $caracterActual;
                //echo '<br>Sin Repetir '.$caracterSinRepetir;
            }
            //

            //echo "<br>Caracter actual de la cadena ". $caracterActual;
        }
        if($caracterActual != $caracterSinRepetir){
            $cadenaSinRepeticiones = $cadenaSinRepeticiones . $caracterSinRepetir;
            $caracterSinRepetir = $caracterActual;
            //echo '<br>Sin Repetir '.$caracterSinRepetir;
        }
        //echo 'Cadena al final: '.$cadenaSinRepeticiones;
        return $cadenaSinRepeticiones;
    }
    public static function seEncuentraLaInstruccionEnElMensaje($instruccion, $mensaje){
        $pos = strpos($mensaje, $instruccion);
        if ($pos === false) {
            return 'NO';
        }else{
            return 'SI';
        }
    }
}
