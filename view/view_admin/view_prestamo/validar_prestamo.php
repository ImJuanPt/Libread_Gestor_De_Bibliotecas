<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Libro.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_index.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_login.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_admin.php";
if (isset($_SESSION["prestamo.libro"]) && isset($_SESSION["prestamo.usuario"])) {
    $libro = $_SESSION["prestamo.libro"];
    $usuario = $_SESSION["prestamo.usuario"];
    $libro = unserialize($libro);
    $usuario = unserialize($usuario);
    $fechas = servicio_admin::select_dates();
} else {
    $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/controllers/Index_adminController.php?accion=null";
    header("Location: $urlBase");
    exit;
}
servicio_login::type_account();
$u = servicio_login::validate_login();
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
                        <a href = '../../../controllers/Index_adminController.php?accion=Perfil'>
                            <img src='../../../Assets/Images/Botones/perfil.png' style = 'margin: auto;margin-left: 55%;'>
                            <p>Perfil</p> 
                        </a>
                </div>
                    <div class='nav'>
                        <a href = '../../../controllers/Index_adminController.php?accion=index_admin'>
                            <img src='../../../Assets/Images/Botones/libro.png' style = 'margin: auto;margin-left: 55%;'>
                            <p>Libros</p> 
                        </a>
                    </div>
                <div class='nav'>
                        <a href = '../../../controllers/LoginController?accion=registrar_libro'>
                            <img src='../../../Assets/Images/Botones/prestamo.png' style = 'margin: auto;margin-left: 55%;'>
                            <p>Registrar libros</p> 
                        </a>
                </div>
            </div>
            <div class='logout2'><a href = '../../../controllers/LoginController?accion=Logout'><button><img src='../../../Assets/Images/Botones/salir.png' ></button></a></div>
        </div>
    </div>

    <div class='contenedor'>";
echo "<div class='libro_content_prestamo_2' id = 'datos'>";

if (!isset($_SESSION['sesion.error']) && $fechas!=null) {
    echo "<h3>Libro solicitado: " . $libro->nombre . "</h3><br>
    <h4>Usuario solicitante: " . $usuario->nombre . "</h4> <br>
    <h4>Fecha del prestamo: " . $fechas[0] . "</h4><br>
    <h4>Fecha maxima para la entrega del libro: " . $fechas[1] . "</h4><br>
    <form action='../../../controllers/Index_adminController.php' method='post'>
       <button type='submit' name = 'accion' value = 'confirmar_prestamo'>Confirmar prestamo</button>
   </form>
       </div>";
} else {
    $msj = "";
    if(isset($_SESSION['sesion.error'])){
        $msj = $_SESSION['sesion.error'];
        $msj = unserialize($msj);
    }
    $msj = $fechas!=null? "hubo un problema con la conexion a la base de datos" : $msj;
    $urlBase = $_SERVER['HTTP_REFERER'];
    echo "<h4>$msj.</h4>
            <br><button style='width: 91px;'><a href = '$urlBase'>Volver</a></button>
       ";
}
echo "</div>
</body>
</html>";
