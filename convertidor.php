<?php
require_once __DIR__ . '/ctrl/archivoEntradaCtrl.php';
require_once __DIR__ . '/ctrl/procesaDatosBeanCtrl.php';
require_once __DIR__ . '/bean/challenge1Bean.php';

/**
 * Realiza la rutina de validar las entradas, limpiar lo puesto en el archivo y crear el archivo
 * @param String $nombreArchivoEntrada La ubicación donde se encuentra el archivo de entrada, así como el nombre del archivo.
 * @param String $archivoDeSalida La ruta donde se almacenará el archivo de salida.
 */
function procesaArchivo($nombreArchivoEntrada, $archivoDeSalida){
    $ctrlEntrada = new archivoEntradaCtrl();
	$beanChallenge1 = $ctrlEntrada->leeArchivo($nombreArchivoEntrada);

    $beanChallenge1->mensaje = procesaDatosBeanCtrl::eliminaCaracteresRepetidosEnMensaje($beanChallenge1->mensaje);

    $myfile = fopen($archivoDeSalida, "w") or die("No se puede abrir el archivo!");

    $instruccion1EnMensaje = procesaDatosBeanCtrl::seEncuentraLaInstruccionEnElMensaje($beanChallenge1->primeraInstruccion,$beanChallenge1->mensaje);
    fwrite($myfile, $instruccion1EnMensaje."\n");
    $instruccion2EnMensaje = procesaDatosBeanCtrl::seEncuentraLaInstruccionEnElMensaje($beanChallenge1->segundaInstruccion,$beanChallenge1->mensaje);
    fwrite($myfile, $instruccion2EnMensaje);
    fclose($myfile);
}

procesaArchivo(__DIR__ ."/entrada.txt", __DIR__ . "/salida.txt");
