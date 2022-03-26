<?php
class procesaDatosBeanCtrl{
    /**
     * Limpia la cadena con el mensaje de los caracteres repetidos
     * @param String $mensaje El mensaje obtenido del archivo de entrada
     * @return string La cadena del mensaje sin caracteres repetidos
     */
    public static function eliminaCaracteresRepetido($mensaje){
        $arrMensaje   = str_split($mensaje);
        $anterior   = "";
        $MensajeNuevo = "";

        foreach ($arrMensaje as $letra) {

            if ($letra != $anterior) {
                $MensajeNuevo .= $letra;
            }

            $anterior = $letra;
        }

        return $MensajeNuevo;
        
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
