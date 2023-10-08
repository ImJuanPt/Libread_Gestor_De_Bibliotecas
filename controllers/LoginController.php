<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/Libread_Gestor_De_Bibliotecas/models/Prestamo.php";

class LoginController{
    public static function ejecutarAccion(){
        $accion = @$_REQUEST["accion"];
        switch($accion){
            case "Login":
                LoginController::login();
                break;
            case "Logout":
                LoginController::Logout();
                break;
            default:
                header("Location:../view/error.php?msj=Accion no permitida");
                exit;
        }
    }

    public static function login(){
        $cedula = @$_REQUEST["cc"];
        $clave = @$_REQUEST["pass"];
        try{
            $u = Usuario::find($cedula);
            if($u->clave == $clave){
                $u = serialize($u);
                $_SESSION["usuario.login"] = $u;
                header("Location:../view/index.php");
                exit;
            }else{
                $_SESSION["usuario.login"] = null;
                header("Location:../view/error.php?msj=Password Incorrecto");
                exit;
            }
        }catch(Exception $error){
            if(strstr($error->getMessage(), $cedula)){
                $msj = "El usuario con Cedula: $cedula no existe";
            }else{
                $msj = "Ocurrio un error al Iniciar Sesion: ".$error->getMessage();
            }
            $_SESSION["usuario.find"] = NULL;
            header("Location:../view/error.php?msj=$msj");
            exit;
        }
    }

    public static function logout(){
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/login.php";
        $_SESSION["usuario.login"] = null;
        header("Location: $urlBase");
    }
}
LoginController::ejecutarAccion();

?>