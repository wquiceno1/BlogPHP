<?php

//conexion
$conex=mysqli_connect("localhost", "root", "", "bd_blog");

if(!$conex){
    echo "La conexion fallo. ";
    exit();

}

if($_FILES['imagen']['error']){

    switch($_FILES['imagen']['error']){

        case 1:
            echo "Archivo demasiado grande para el servidor.";
            break;
        case 2:
            echo "El tamaño de la imagen es demasiado grande.";
            break;
        case 3:
            echo "Fallo durante la carga de la imagen.";
            break;
        case 4:
            echo "No se envio ningun archivo";
            break;

    }

} else {

    echo "Imagen cargada correctamente.<br>";
    if(isset($_FILES['imagen']['name']) && ($_FILES['imagen']['error'] == UPLOAD_ERR_OK)){
        $ruta='imagenes/';
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta.$_FILES['imagen']['name']);
        echo "El archivo ".$_FILES['imagen']['name']." se copio en el directorio de imagenes<br>";

    } else {
        echo "No se pudo copiar la imagen en el directorio. ";
    }

}

//cargar las variables
date_default_timezone_set('America/Bogota');

$titulo=$_POST['titulo'];
$fecha = date("Y-m-d H:i:s");
echo "fecha: ".$fecha;
$contenido=$_POST['contenido'];
$email=$_POST['email'];
$imagen=$_FILES['imagen']['name'];

$query="INSERT INTO contenido (titulo, fecha, contenido, email, imagen) 
        VALUES ('".$titulo."', '".$fecha."', '".$contenido."', '".$email."', '".$imagen."')";
$result=mysqli_query($conex, $query);

mysqli_close($conex);

echo "<br>Entrada agregada con exito. <br><br>"
?>