<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/controllers/verificacion_sesion_controller.php";
if(isset($_SESSION["prestamo.libro"])){
    $libro = $_SESSION["prestamo.libro"];
    $libro = unserialize($libro);
}else{
    $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/controllers/PrestamoController.php?accion=null";
    header("Location: $urlBase");
    exit;
}
verificacion_sesion_controller::redic_valid_login();
$u = unserialize($_SESSION["usuario.login"]);
echo "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Perfil</title>
        <link rel='stylesheet' type='text/css' href='../../../Assets/Css/style_insertLibro.css'>
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <script src='../../../Assets/JS/script_pass.js'></script>
        <script src='../../../Assets/JS/script.js'></script>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='../../../Assets/Css/style_index.css'>
        <link rel='stylesheet' href='../../../Assets/Css/style_libros.css'>
        <link rel='stylesheet' href='../../../Assets/Css/style_vistas.css'>
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <meta http-equiv='Cache-Control' content='no-cache, must-revalidate'>
    </head>
        <body>
        <div class='content'>
            <div class='logo'>
                <img src='../../../assets/Images/Logo/image-removebg-preview.png'>
            </div>
                <div class='container-nav'>
                    <div class='nav'>
                            <a href = '../../../controllers/UsuarioController.php?accion=Perfil'>
                                <img src='../../../Assets/Images/Botones/perfil.png' style = 'margin: auto;margin-left: 55%;'>
                                <p>Perfil</p> 
                            </a>
                    </div>
                        <div class='nav'>
                            <a href = '../../../controllers/UsuarioController.php?accion=Index'>
                                <img src='../../../Assets/Images/Botones/libro.png' style = 'margin: auto;margin-left: 55%;'>
                                <p>Libros</p> 
                            </a>
                        </div>
                    <div class='nav'>
                            <a href = '../../../controllers/LibroController.php?accion=registrar_libro'>
                                <img src='../../../Assets/Images/Botones/prestamo.png' style = 'margin: auto;margin-left: 55%;'>
                                <p>Registrar libros</p> 
                            </a>
                    </div>
                </div>
                <div class='logout2'><a href = '../../../controllers/UsuarioController.php?accion=Logout'>
                    <button><img src='../../../Assets/Images/Botones/salir.png' ></button></a>
                </div>
            </div>
        </div>
            <div class='contenedor'>
                <div class='libro_content_prestamo' id = 'datos'>
                    <h3>Libro solicitado: ". $libro->nombre. "</h3>
                    <form action='../../../controllers/PrestamoController.php' method='post' enctype='multipart/form-data'>
                        <label><h4>Cedula del solicitante</label>
                        <input type='number' name='cedula_solicitante' required></h4>
                        <input type='hidden' name='id_libro' value='".$libro->id_libro."'>
                        <button type='submit' name = 'accion' value = 'validar_prestamo'>Continuar</button>
                    </form>
                </div>
            </div>
        </body>
    </html>
        ";
