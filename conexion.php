<?php
//conexion aca pongo mas comentarios de prueba porque sigo en pruebas
$conex=mysqli_connect("localhost", "root", "", "bd_blog");

if(!$conex){
    echo "La conexion fallo. ";
    exit();

}

?>