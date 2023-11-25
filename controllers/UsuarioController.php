<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Prestamo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/controllers/verificacion_sesion_controller.php";
class UsuarioController
{
    public static $urlIndex;
    public static $urlIndexAdmin;
    public static $urlLogin;
    public static $urlError;

    public static function inicializarVariables()
    {
        self::$urlIndex = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_user/index.php";
        self::$urlIndexAdmin = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/index_admin.php";
        self::$urlLogin = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/login.php";
        self::$urlError = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php?msj=";
    }

    public static function ejecutarAccion()
    {
        $accion = @$_REQUEST["accion"];
        switch ($accion) {
            case "Login":
                self::login();
                break;
            case "register":
                self::register();
                break;
            case "Index":
                self::index();
                break;
            case "Perfil":
                self::Perfil();
                break;
            case "Perfil_edit":
                self::Perfil_edit();
                break;
            case "insert_edit_profile":
                self::editar_perfil();
                break;
            case "Logout":
                self::Logout();
                break;
            default:
                header("Location:../view/error.php?msj=Accion no permitida" . $accion);
                exit;
        }
    }

    public static function login()
    {
        //comprobar si las variables estan definidas y no nulas, si es asi, se obtienen las variables, si no se define como ""
        $cedula = isset($_REQUEST["cc"]) ? $_REQUEST["cc"] : "";
        $clave = isset($_REQUEST["pass"]) ? $_REQUEST["pass"] : "";

        try {
            if ($cedula !== "" && $clave !== "") {
                //metodo login retorna un array, en la posicion 1 se guarda un boolean de si fue exitosa la operacion, en el 2 un mensaje de dicha operacion

                service_Usuario::login($cedula, $clave);
                $answ = isset($_SESSION["login.respuesta"]) ? unserialize($_SESSION["login.respuesta"]) : null;
                if ($answ[1]) {
                    $user = verificacion_sesion_controller::redic_valid_login();
                    if ($user->tipo_usuario == "ADMIN") {
                        header("Location: " . self::$urlIndexAdmin);
                        exit;
                    } else {
                        header("Location: " . self::$urlIndex);
                        exit;
                    }
                } else {
                    throw new Exception($answ[2]);
                }
            } else {
                throw new Exception("Debe llenar todos los campos para continuar");
            }
        } catch (Exception $e) {
            header("Location: ".self::$urlError . "Ocurrio un error: " . $e->getMessage());
        }
    }

    public static function register()
    {
        $cedula = isset($_REQUEST["cc"]) ? $_REQUEST["cc"] : "";
        $clave = isset($_REQUEST["contra"]) ? $_REQUEST["contra"] : "";
        $apellido1 = isset($_REQUEST["apellido1"]) ? $_REQUEST["apellido1"] : "";
        $apellido2 = isset($_REQUEST["apellido2"]) ? $_REQUEST["apellido2"] : "";
        $correo = isset($_REQUEST["correo"]) ? $_REQUEST["correo"] : "";
        $nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : "";
        try {
            if ($cedula !== "" && $clave !== "" && $apellido1 !== "" && $apellido2 !== "" && $correo !== "" && $nombre !== "") {
                service_Usuario::register($cedula, $clave, $apellido1, $apellido2, $correo, $nombre);
                $answ = unserialize($_SESSION["register.respuesta"]);
                if ($answ[1]) {
                    header("Location: ".self::$urlIndex . "?msj=$answ[2]");
                    exit;
                } else {
                    throw new Exception(urldecode($answ[2]));
                }
            } else {
                throw new Exception("Debe llenar todos los campos para continuar");
            }
        } catch (Exception $e) {
            header("Location: ".self::$urlError . "Ocurrio un error: " . $e->getMessage());
        }
    }
    public static function index()
    {
        $user = verificacion_sesion_controller::redic_valid_login();
        if ($user->tipo_usuario == "ADMIN") {
            header("Location: " . self::$urlIndexAdmin);
            exit;
        }
        header("Location: ". self::$urlIndex);
    }
    public static function Perfil()
    {
        $user = verificacion_sesion_controller::redic_valid_login();
        if ($user->tipo_usuario == "ADMIN") {
            $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/profile.php";
            header("Location: $urlBase");
            exit;
        }
        header("Location: ../view/view_user/profile_user");
        exit;
    }

    public static function Perfil_edit()
    {
        $user = verificacion_sesion_controller::redic_valid_login();
        if ($user->tipo_usuario == "ADMIN") {
            $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/profile_editar.php";
            header("Location: $urlBase");
            exit;
        }
        header("Location: ../view/view_user/profile_editar_user");
        exit;
    }

    public static function editar_perfil()
    {
        $cedula = isset($_REQUEST["cedula"]) ? $_REQUEST["cedula"] : "";
        $clave = isset($_REQUEST["contra"]) ? $_REQUEST["contra"] : "";
        $apellido1 = isset($_REQUEST["apellido1"]) ? $_REQUEST["apellido1"] : "";
        $apellido2 = isset($_REQUEST["apellido2"]) ? $_REQUEST["apellido2"] : "";
        $correo = isset($_REQUEST["email"]) ? $_REQUEST["email"] : "";
        $nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : "";
        try {
            if ($cedula !== "" && $clave !== "" && $apellido1 !== "" && $apellido2 !== "" && $correo !== "" && $nombre !== "") {
                service_Usuario::edit_profile($nombre, $apellido1, $apellido2, $clave, $correo, $cedula);
                $answ = unserialize($_SESSION["edit_profile.respuesta"]);
                if ($answ[1]) {
                    $user = verificacion_sesion_controller::redic_valid_login();
                    if ($user->tipo_usuario == "ADMIN") {
                        header("Location:../view/view_admin/profile.php?msj=" . $answ[2]);
                        exit;
                    }
                    header("Location: ../view/view_user/profile_user");
                    exit;
                } else {
                    throw new Exception(urldecode($answ[2]));
                }
            } else {
                throw new Exception("Debe llenar todos los campos para continuar");
            }
        } catch (Exception $e) {
            header(self::$urlError . $e->getMessage());
        }
    }

    public static function Logout()
    {
        service_Usuario::Logout();
        header("Location: " . self::$urlLogin);
    }
}

UsuarioController::inicializarVariables();
UsuarioController::ejecutarAccion();
