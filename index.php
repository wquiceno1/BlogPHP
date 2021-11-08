<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog William Quiceno</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <?php require_once("conexion.php");?>
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!">Blog William Quiceno</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>                        
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Bienvenido al inicio del blog.</h1>
                    <p class="lead mb-0">Proyecto desarrollado en HTML/CSS/PHP/MYSQL</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="container">          
                    <h2 class="card-title">Agregar entradas</h2>
                    <div class="card w-75">
                        <form action="index.php" method="post" enctype="multipart/form-data">
                            <input type="text" name="titulo"><br><br>
                            <input type="email" name="email" id="email" placeholder="Email"><br><br>
                            <input type="file" name="imagen" id="imagen"><br><br>
                            <textarea class="form-control" name="contenido" rows="3"></textarea><br><br>
                            <input type="submit" class="btn btn-success" name="guardar" value="Guardar">
                        </form>
                    </div>                 
                    <?php
                    if(isset($_REQUEST['guardar'])){
                        

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
                        
                            //echo "Imagen cargada correctamente.<br>";
                            if(isset($_FILES['imagen']['name']) && ($_FILES['imagen']['error'] == UPLOAD_ERR_OK)){
                                $ruta='imagenes/';
                                move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta.$_FILES['imagen']['name']);
                                //echo "El archivo ".$_FILES['imagen']['name']." se copio en el directorio de imagenes<br>";
                        
                            } else {
                                echo "No se pudo copiar la imagen en el directorio. ";
                            }
                        
                        }
                        
                        //cargar las variables
                        date_default_timezone_set('America/Bogota');
                        
                        $titulo=$_POST['titulo'];
                        $fecha = date('Y-m-d H:i:s');
                        $contenido=$_POST['contenido'];
                        $email=$_POST['email'];
                        $imagen=$_FILES['imagen']['name'];
                        
                        $query="INSERT INTO contenido (titulo, fecha, contenido, email, imagen) 
                                VALUES ('".$titulo."', '".$fecha."', '".$contenido."', '".$email."', '".$imagen."')";
                        $result=mysqli_query($conex, $query);
                        
                        
                        
                        echo "<br>Entrada agregada con exito. <br><br>";

                       }
                       // consultar los post

                       $consulta="SELECT * FROM contenido ORDER BY fecha DESC";
                    echo "<br><h1>Lista de post</h1><hr>";
                       if($resultado=mysqli_query($conex,$consulta)){
                           while($post=mysqli_fetch_assoc($resultado)){?>
                           
                            
                            

                            <div class="row">
                                <div class="col-sm-6">                            
                                    <h2 class="card-title"><?php echo $post['titulo'];?></h2>
                                    <a href="#!"><img class="card-img-top" src="imagenes/<?php echo $post['imagen'];?>" alt="..." width="200px"/></a>                                
                                </div>
                                <br><br>
                                <div class="col-sm-6">
                                <div class="card-body">
                                        <div class="small text-muted"><?php echo $post['fecha'];?></div>
                                        
                                        <p class="card-text"><?php echo $post['contenido'];?></p>
                                        
                                    </div>
                                </div>
                            </div>
                            <br><hr><br>
                    <?php
                            }

                        }mysqli_close($conex);?>

                </div>                
            </div>
        </div>
        <br><br>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
