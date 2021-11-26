<?php
//conexion aca pongo mas comentarios de prueba
$conex=mysqli_connect("localhost", "root", "", "bd_blog");

if(!$conex){
    echo "La conexion fallo. ";
    exit();

}

?>