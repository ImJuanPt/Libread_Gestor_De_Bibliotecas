<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/LibrosGenero.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Anuncio.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Libro.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_index.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_login.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/controllers/verificacion_sesion_controller.php";

if(isset($_REQUEST["msj"])){
    echo '<script>alert("Los datos han sido actualizados con éxito");</script>';
}
verificacion_sesion_controller::redic_valid_login();
$u = unserialize($_SESSION["usuario.login"]);
echo "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Perfil</title>
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <script src='../../Assets/JS/script_pass.js'></script>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='../../Assets/Css/style_index.css'>
        <link rel='stylesheet' href='../../Assets/Css/style_libros.css'>
        <link rel='stylesheet' href='../../Assets/Css/style_vistas.css'>
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <meta http-equiv='Cache-Control' content='no-cache, must-revalidate'>
    </head>
        <body>
        <div class='content'>
            <div class='logo'>
                <img src='../../assets/Images/Logo/image-removebg-preview.png'>
            </div>
            <div class='container-nav'>
                <div class='nav'>
                        <a href = '../../controllers/Index_adminController.php?accion=Perfil'>
                            <img src='../../Assets/Images/Botones/perfil.png' style = 'margin: auto;margin-left: 55%;'>
                            <p>Perfil</p> 
                        </a>
                </div>
                    <div class='nav'>
                        <a href = '../../controllers/Index_adminController.php?accion=index_admin'>
                            <img src='../../Assets/Images/Botones/libro.png' style = 'margin: auto;margin-left: 55%;'>
                            <p>Libros</p> 
                        </a>
                    </div>
                <div class='nav'>
                        <a href = '../../controllers/LoginController?accion=registrar_libro'>
                            <img src='../../Assets/Images/Botones/prestamo.png' style = 'margin: auto;margin-left: 55%;'>
                            <p>Registrar libros</p> 
                        </a>
                </div>
            </div>
            <div class='logout2'><a href = '../../controllers/LoginController?accion=Logout'><button><img src='../../Assets/Images/Botones/salir.png' ></button></a></div>
        </div>
    </div>
    
    <div class='content_profile'>
        <div class='backgroundimage'> <img class='imagenperfil' src='../../Assets/Images/Botones/usuario.png'></div>
        <p>Puntos:</p>
        <p>Nombre:</p>
        <p>Primer apellido:</p>
        <p>Segundo apellido:</p>
        <p>Cedula:</p>
        <p>Correo:</p>
        <p>Contraseña:</p>
        <button id='ver_pass'; onclick='mostrar_contra();'><img class='ver_contra'
        src='../../Assets/Images/Botones/ojo.png'></button>

        <button id='ocultar_pass' onclick='quitar_contra();'> <img class='ver_contra' src='../../Assets/Images/Botones/ojos-cruzados.png'>
        </button>
                
        <div class='user_info' >
            <form action='../../controllers/profile_editController.php' method='post'>
                <p class='puntos' id ='user_info_edit'>". $u->puntaje."</p> 
                <p class='nombre' id='user_info_edit'>". $u->nombre."</p>
                <p class='apellido' id='user_info_edit'>". $u->apellido_1."</p>
                <p class='apellido' id='user_info_edit'>". $u->apellido_2."</p>
                <p class='cedula' id='user_info_edit'>". $u->cedula."</p>
                <p class='correo' id='user_info_edit'>". $u->correo."</p><br>
                <p id='contraseña' >". $u->passw."</p>
                <button value = 'profile' name = 'accion' type = 'submit' class=editar;> <img class='editar2' src='../../Assets/Images/Botones/lapiz-de-usuario.png'></button>
            </form>
        </div>
    </div>

    
</body>

</html>
";
?>