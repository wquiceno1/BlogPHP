<?php
//conexion
$conex=mysqli_connect("localhost", "root", "", "bd_blog");

if(!$conex){
    echo "La conexion fallo. ";
    exit();

}

?>