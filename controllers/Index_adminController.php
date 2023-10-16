<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Prestamo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_login.php";

class Index_adminController
{

    public static function ejecutarAccion()
    {
        $accion = @$_REQUEST["accion"];
        switch ($accion) {
            case "Perfil":
                Index_adminController::Perfil();
                break;
            case "Perfil_edit":
                Index_adminController::Perfil_edit();
                break;
            case "index_admin":
                Index_adminController::index_admin();
                break;
            default:
                header("Location:../view/error.php?msj=Accion no permitida");
                exit;
        }
    }

    public static function Perfil()
    {
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/profile.php";
        header("Location: $urlBase");
    }
    public static function Perfil_edit()
    {
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/profile_editar.php";
        header("Location: $urlBase");
    }
    public static function index_admin()
    {
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/index_admin.php";
        header("Location: $urlBase");
    }
}

Index_adminController::ejecutarAccion();
