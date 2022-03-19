<?php
require_once __DIR__ . '/archivoEntradaCtrl.php';
require_once __DIR__ . '/procesaDatosBeanCtrl.php';
require_once __DIR__ . '/challenge1Bean.php';

function procesaArchivo($nombreArchivo){
    $ctrlEntrada = new archivoEntradaCtrl();
	$beanChallenge1 = $ctrlEntrada->leeArchivo($nombreArchivo);
    //echo "<br>Resultado del analisis: " ;
    //var_dump($beanChallenge1);

    $beanChallenge1->mensaje = procesaDatosBeanCtrl::eliminaCaracteresRepetidosEnMensaje($beanChallenge1->mensaje);

    //echo "<br>Mensaje sin repeticiones: ".$beanChallenge1->mensaje;

    $myfile = fopen(__DIR__ . "/salida.txt", "w") or die("No se puede abrir el archivo!");

    $instruccion1EnMensaje = procesaDatosBeanCtrl::seEncuentraLaInstruccionEnElMensaje($beanChallenge1->primeraInstruccion,$beanChallenge1->mensaje);
    fwrite($myfile, $instruccion1EnMensaje."\n");
    $instruccion2EnMensaje = procesaDatosBeanCtrl::seEncuentraLaInstruccionEnElMensaje($beanChallenge1->segundaInstruccion,$beanChallenge1->mensaje);
    fwrite($myfile, $instruccion2EnMensaje);
    fclose($myfile);
}

procesaArchivo("./entrada.txt");
