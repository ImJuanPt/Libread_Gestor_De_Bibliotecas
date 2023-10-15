<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Prestamo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_login.php";

class LoginController
{
    public static function ejecutarAccion()
    {
        $accion = @$_REQUEST["accion"];
        switch ($accion) {
            case "Login":
                LoginController::login();
                break;
            case "register":
                LoginController::register();
                break;
            case "Logout":
                LoginController::Logout();
                break;
            default:
                header("Location:../view/error.php?msj=Accion no permitida");
                exit;
        }
    }

    public static function login()
    {
        //comprobar si las variables estan definidas y no nulas, si es asi, se obtienen las variables, si no se define como ""
        $cedula = isset($_REQUEST["cc"]) ? $_REQUEST["cc"] : "";
        $clave = isset($_REQUEST["pass"]) ? $_REQUEST["pass"] : "";

        if ($cedula !== "" && $clave !== "") {
            //metodo login returna un array, en la posicion 1 se guarda un boolean de si fue exitosa la operacion, en el 2 un mensaje de dicha operacion
            $answ = servicio_login::login($cedula, $clave);
            if ($answ[1]) {
                if (servicio_login::type_account()) {
                    header("Location:../view/view_admin/index_admin.php?msj=$answ[2]");
                    exit;
                }
                header("Location:../view/index.php?msj=$answ[2]");
                exit;
            } else {
                header("Location:../view/error.php?msj=$answ[2]");
                exit;
            }
        } else {
            header("Location:../view/error.php?msj=Debe llenar todos los campos para continuar");
            exit;
        }
    }

    public static function Logout()
    {
        servicio_login::Logout();
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/login.php";
        header("Location: $urlBase");
    }


    public static function register()
    {
        $cedula = isset($_REQUEST["cc"]) ? $_REQUEST["cc"] : "";
        $clave = isset($_REQUEST["contra"]) ? $_REQUEST["contra"] : "";
        $apellido1 = isset($_REQUEST["apellido1"]) ? $_REQUEST["apellido1"] : "";
        $apellido2 = isset($_REQUEST["apellido2"]) ? $_REQUEST["apellido2"] : "";
        $correo = isset($_REQUEST["correo"]) ? $_REQUEST["correo"] : "";
        $nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : "";
        if ($cedula !== "" && $clave !== "" && $apellido1 !== "" && $apellido2 !== "" && $correo !== "" && $nombre !== "") {
            $u = new Usuario();
            $u->cedula = $cedula;
            $u->passw = $clave;
            $u->apellido_1 = $apellido1;
            $u->apellido_2 = $apellido2;
            $u->correo = $correo;
            $u->nombre = $nombre;
            $answ = servicio_login::register($u);
            if ($answ[1]) {
                header("Location:../view/index.php?msj=$answ[2]");
                exit;
            } else {
                header("Location:../view/error.php?msj=" . urldecode($answ[2]));
                exit;
            }
        } else {
            header("Location:../view/error.php?msj=Debe llenar todos los campos para continuar" . $cedula . $clave . $apellido1 . $apellido2 . $correo . $nombre);
            exit;
        }
    }
}
LoginController::ejecutarAccion();
