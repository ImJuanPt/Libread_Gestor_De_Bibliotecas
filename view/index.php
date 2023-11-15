<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Anuncio.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Anuncio.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_login.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/controllers/verificacion_sesion_controller.php";

$msj = @$_REQUEST["msj"];
verificacion_sesion_controller::redic_valid_login();
$u = unserialize($_SESSION["usuario.login"]);
$datos = service_Anuncio::lasts_anunces();

echo "
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='../Assets/Css/style_index.css'>
    <title>Libread</title>
    <script src='script.js'></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>

<body>
    <div class='content'>
        <div class='logo'>
            <img src='../assets/Images/Logo/image-removebg-preview.png'>
        </div>
        <div class='container-nav'>
            <div class='nav'>
                    <a style='cursor: pointer' href = '../controllers/Index_userController?accion=Perfil'>>
                    <img src='../Assets/Images/Botones/perfil.png' style = 'margin: auto;margin-left: 55%;'>
                    <p>Perfil</p> 
                </a>
            </form>
            </div>
            <div class='nav'>
                <form id = 'enviar_datos_libro" . $u->cedula . "' action='listado_libros.php' method='post'>
                <input type='hidden' name='cc_usuario_sesion' value='" . $u->cedula . "'>
                <a style='cursor: pointer' onclick='submitForm(\"enviar_datos_libro" . $u->cedula . "\")'>
                    <img src='../Assets/Images/Botones/libro.png' style = 'margin: auto;margin-left: 55%;'>
                    <p>Libros</p> 
                </a>
            </form>
            </div>
            <div class='nav'>
                <form id = 'enviar_datos_prestamo" . $u->cedula . "' action='prestamo.php' method='post'>
                    <input type='hidden' name='cc_usuario_sesion' value='" . $u->cedula . "'>
                    <a style='cursor: pointer' onclick='submitForm(\"enviar_datos_prestamo" . $u->cedula . "\")'>
                        <img src='../Assets/Images/Botones/prestamo.png' style = 'margin: auto;margin-left: 55%;'>
                        <p>Prestamos</p> 
                    </a>
                </form>
            </div>
            <div class='nav'>
            <form id = 'enviar_datos_devolucion" . $u->cedula . "' action='devoluciones.php' method='post'>
                <input type='hidden' name='cc_usuario_sesion' value='" . $u->cedula . "'>
                <a style='cursor: pointer' onclick='submitForm(\"enviar_datos_devolucion" . $u->cedula . "\")'>
                    <img src='../Assets/Images/Botones/devolucion.png' style = 'margin: auto;margin-left: 55%;'>
                    <p>Devoluciones</p> 
                </a>
            </form>
            </div>
            <div class='logout'><a href = '../controllers/LoginController.php?accion=Logout'><button><img src='../Assets/Images/Botones/salir.png' ></button><a></div>
        </div>
    </div>
    <div class='home'>
        <form id = 'enviar_datos_usuario" . $u->cedula . "' action='index.php' method='post'>
            <input type='hidden' name='cc_usuario_sesion' value='" . $u->cedula . "'>
            <a style='cursor: pointer' onclick='submitForm(\"enviar_datos_usuario" . $u->cedula . "\")'>
                <img src='../Assets/Images/Botones/separador.png' style = 'margin: auto;margin-left: 55%;'>
            </a>
        </form>
    </div>
    <div class='welcome'>
        <div>
            <p class='bienvenido'>Bienvenido " . $u->nombre ."!</p>
            <p class='aventura'>¿Que aventura tendrás el día de hoy?</p>
        </div>
    </div>
    <div class='notices'>

        <div class='content_notices'>
            <div class='noticias'>
                <p class='titulo'>" . $datos[0]['tipo_anuncio'] . "</p>
                <img src='../Assets/" . $datos[0]['img_portada'] . "' alt=''>
                <p class='descripcion'> " . $datos[0]['descripcion'] . "</p>
            </div>
        </div>
        <div class='notices2'>
            <div class='content_notices'>
                <div class='noticias'>
                    <p class='titulo'>" . $datos[1]['tipo_anuncio'] . "</p>
                    <img src='../Assets/" . $datos[1]['img_portada'] . "' alt=''>
                    <p class='descripcion'> " . $datos[1]['descripcion'] . "</p>
                </div>
            </div>
            <div class='notices3'>
                <div class='content_notices'>
                    <div class='noticias'>
                    <p class='titulo'>" . $datos[2]['tipo_anuncio'] . "</p>
                    <img src='../Assets/" . $datos[2]['img_portada'] . "' alt=''>
                    <p class='descripcion'> " . $datos[2]['descripcion'] . "</p>
                    </div>
                </div>
            </div>
</body>

</html>
";