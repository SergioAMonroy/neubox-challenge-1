<?php

require_once __DIR__ . '/ctrl/archivoEntradaCtrl.php';
require_once __DIR__ . '/ctrl/procesaDatosBeanCtrl.php';
require_once __DIR__ . '/bean/challenge1Bean.php';

/**
 * Realiza la rutina de validar las entradas, limpiar lo puesto en el archivo y crear el archivo
 * @param String $nombreArchivoEntrada La ubicación donde se encuentra el archivo de entrada, así como el nombre del archivo.
 * @param String $archivoDeSalida La ruta donde se almacenará el archivo de salida.
 */
function procesaArchivo($nombreArchivoEntrada, $archivoDeSalida) {
    $ctrlEntrada = new archivoEntradaCtrl();
    try {
        $beanChallenge1 = $ctrlEntrada->leeArchivo($nombreArchivoEntrada);
    } catch (MyException $e) {

        throw $e;
    }
    if($beanChallenge1->primeraInstruccion != procesaDatosBeanCtrl::eliminaCaracteresRepetido($beanChallenge1->primeraInstruccion)){
        throw new Exception('La instrucción 1 contiene caracteres repetidos');
    }
    if($beanChallenge1->segundaInstruccion != procesaDatosBeanCtrl::eliminaCaracteresRepetido($beanChallenge1->segundaInstruccion)){
        throw new Exception('La instrucción 2 contiene caracteres repetidos');
    }
    
    $beanChallenge1->mensaje = procesaDatosBeanCtrl::eliminaCaracteresRepetido($beanChallenge1->mensaje);

    $contadorInstruccion1EnMensaje = substr_count($beanChallenge1->mensaje, $beanChallenge1->primeraInstruccion);
    
    if(contadorInstruccion1EnMensaje>1)){
        throw new Exception('La instrucción 1 se encuentra en mas de una ocasión en el mensaje');
    }

    $contadorInstruccion2EnMensaje = substr_count($beanChallenge1->mensaje, $beanChallenge1->segundaInstruccion);
    
    if(contadorInstruccion2EnMensaje){
        throw new Exception('La instrucción 2 se encuentra en mas de una ocasión en el mensaje');
    }


    $instruccion1EnMensaje = procesaDatosBeanCtrl::seEncuentraLaInstruccionEnElMensaje($beanChallenge1->primeraInstruccion, $beanChallenge1->mensaje);    
    $instruccion2EnMensaje = procesaDatosBeanCtrl::seEncuentraLaInstruccionEnElMensaje($beanChallenge1->segundaInstruccion, $beanChallenge1->mensaje);

    if($instruccion1EnMensaje == 'SI' && $instruccion2EnMensaje == 'SI'){
        throw new Exception('Las dos instrucciones se encuentran en el mensaje, por lo que no se pudo definir cual instruccion esta en el mensaje');
    }    

    $myfile = fopen($archivoDeSalida, "w") or die("No se puede abrir el archivo!");

    
    fwrite($myfile, $instruccion1EnMensaje . "\n");
    
    fwrite($myfile, $instruccion2EnMensaje);
    fclose($myfile);
    return '{"mensaje":"Exito"}';
}

$uploadfile = __DIR__ . '/subidas/entrada.txt';

if (!move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadfile)) {
    http_response_code(404);
    echo '{"mensaje":"No fue posible subir el archivo"}';
}

try {
    
    echo procesaArchivo(__DIR__ . "/subidas/entrada.txt", __DIR__ . "/subidas/salida.txt");
    
} catch (Exception $e) {
    http_response_code(404);
    echo '{"mensaje":"'.$e->getMessage().'"}';
} 

