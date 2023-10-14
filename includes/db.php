<?php

    $host = "bqkml1hdkjdnadoq0zdw-mysql.services.clever-cloud.com";
    $user = "uk7qfvzrwmladkaa";
    $password = "UkI7cvDtUOvLgN9viytH";
    $database = "bqkml1hdkjdnadoq0zdw";

    $conexion = mysqli_connect($host, $user, $password, $database);
    if(!$conexion){
        echo "No se realizo la conexion a la basa de datos, el error fue:".
        mysqli_connect_error() ;
        header("Location: ../index.php");
        exit();
    }

?>