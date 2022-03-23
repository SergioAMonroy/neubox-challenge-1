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
    $beanChallenge1->mensaje = procesaDatosBeanCtrl::eliminaCaracteresRepetidosEnMensaje($beanChallenge1->mensaje);

    $myfile = fopen($archivoDeSalida, "w") or die("No se puede abrir el archivo!");

    $instruccion1EnMensaje = procesaDatosBeanCtrl::seEncuentraLaInstruccionEnElMensaje($beanChallenge1->primeraInstruccion, $beanChallenge1->mensaje);
    fwrite($myfile, $instruccion1EnMensaje . "\n");
    $instruccion2EnMensaje = procesaDatosBeanCtrl::seEncuentraLaInstruccionEnElMensaje($beanChallenge1->segundaInstruccion, $beanChallenge1->mensaje);
    fwrite($myfile, $instruccion2EnMensaje);
    fclose($myfile);
    return '{"mensaje":"Exito"}';
    //return "{'mensaje':'Exito'}";
}

//var_dump($_FILES);
/*
  $uploaddir = __DIR__ . '/subidas/';
  $uploadfile = $uploaddir . 'entrada.txt';
 * 
 */

$uploaddir = __DIR__ . '/subidas/';
$uploadfile = $uploaddir . basename($_FILES['archivo']['name']);

//echo "Subiendo el archivo " . $uploadfile;

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

