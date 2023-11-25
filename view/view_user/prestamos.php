<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Prestamo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/controllers/verificacion_sesion_controller.php";

$msj = @$_REQUEST["msj"];
verificacion_sesion_controller::redic_valid_login();
$u = unserialize($_SESSION["usuario.login"]);
$result = service_Prestamo::findPrestamoUser($u->cedula, "NO ENTREGADO");
$i = 0;
echo "
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='../../Assets/Css/style_index.css'>
    <link rel='stylesheet' href='../../Assets/Css/prestamo.css'>
    <link rel='stylesheet' href='../../Assets/Css/style_libros.css'>
    <link rel='stylesheet' href='../../Assets/Css/style_tabla_entrega_libro.css'>
    <title>Libread</title>
    <script src='script.js'></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>

<body>
    <div class='content'>
        <div class='logo'>
            <img src='../../assets/Images/Logo/image-removebg-preview.png'>
        </div>
        <div class='container-nav'>
            <div class='nav'>
                <a style='cursor: pointer' href = '../../controllers/UsuarioController.php?accion=Perfil'>
                    <img src='../../Assets/Images/Botones/perfil.png' style = 'margin: auto;margin-left: 55%;'>
                    <p>Perfil</p> 
                </a>
            </form>
            </div>
            <div class='nav'>
                <a style='cursor: pointer' href = '../../controllers/LibroController.php?accion=listado_libros_usuario'>
                    <img src='../../Assets/Images/Botones/libro.png' style = 'margin: auto;margin-left: 55%;'>
                    <p>Libros</p> 
                </a>
            </div>
            <div class='nav'>
                <a style='cursor: pointer' href = '../../controllers/PrestamoController.php?accion=prestamos_usuario'>
                    <img src='../../Assets/Images/Botones/prestamo.png' style = 'margin: auto;margin-left: 55%;'>
                    <p>Prestamos</p> 
                </a>
                </form>
            </div>
            <div class='nav'>
                <a style='cursor: pointer' href = '../../controllers/PrestamoController.php?accion=devoluciones_usuario'>
                    <img src='../../Assets/Images/Botones/devolucion.png' style = 'margin: auto;margin-left: 55%;'>
                    <p>Devoluciones</p> 
                </a>
            </form>
            </div>
            <div class='logout'><a href = '../../controllers/UsuarioController.php?accion=Logout'><button><img src='../../Assets/Images/Botones/salir.png' ></button><a></div>
        </div>
    </div>
    <div class='home'>
        <form action='index.php' method='post'>
            <a style='cursor: pointer'>
                <img src='../../Assets/Images/Botones/separador.png' style = 'margin: auto;margin-left: 55%;'>
            </a>
        </form>
    </div>

    <div class='contenedor2'>
        <table class='rwd-table' style = 'margin-left: 45px;'>
            <tr>
                <th>Portada</th>
                <th>Nombre</th>
                <th>Fecha prestamo</th>
                <th>Fecha devolución</th>
            </tr>
            ";
            foreach ($result as $row_prestamo) {
                $i++;
            echo"
            <tr>
                <td><img style='width: 100px; height: 160px;' src='../../Assets/".$row_prestamo['img_portada']."' alt=''></td>
                <td>".$row_prestamo['nombre']."</td>
                <td>".$row_prestamo['fecha_prestamo']."</td>
                <td>".$row_prestamo['fecha_max_devolucion']."</td>
            </tr>";
        }
        if($i == 0){
            echo "<tr>
                    <td>El usuario no tiene prestamos activos actualmente</td>
                 </tr>";
        };
            echo"
        </table>
    </div>


</body>

</html>
"

?>