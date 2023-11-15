<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Prestamo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Usuario.php";
class verificacion_sesion_controller
{

    public static function redic_valid_login()
    {
        $urlIndexAdmin = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/index_admin.php";
        $urlIndex = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/index.php";
        $urlLogin = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/login.php";

        $pass = service_Usuario::validate_login();
        //verificamos que haya un usuario con su sesion iniciada
        if ($pass) {
            //si hay un usuario y es administrador lo retornamos, pero la sesion activa debe ser de administrador
            if ($pass->tipo_usuario == "ADMIN") {
                return $pass;
            } else {
                //si el usuario no es administrador y se esta en una vista de administrador se le redirije al login
                if (stripos($_SERVER['PHP_SELF'], "admin")) {
                    header("Location: $urlLogin");
                    exit;
                }
            }
        } else {
            //si no hay una sesion activa y no estamos en login, significa que intenta ingresar a una vista de admimistrador sin haber iniciado sesion luego -
            //verificamos si la ruta actual es distinta a la que se redirije si no se ha iniciado sesion, sino entra en buqle
            if ($_SERVER['PHP_SELF'] != "/Libread_Gestor_De_Bibliotecas/view/login.php") {
                header("Location: $urlLogin");
                exit;
            }
        }
    }
}
