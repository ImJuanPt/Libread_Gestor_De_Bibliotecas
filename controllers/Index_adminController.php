<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Prestamo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_login.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_admin.php";

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
            case "registrar_libro":
                Index_adminController::registrar_libro();
                break;
            case "registrar_libro_insert":
                Index_adminController::registrar_libro_insert();
                break;
            case "Eliminar":
                Index_adminController::libro_delete();
                break;
            case "Editar":
                Index_adminController::libro_Edit();
                break;
            case "Editar_insert":
                Index_adminController::libro_Edit_insert();
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

    public static function registrar_libro()
    {
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/insert_libro.php";
        header("Location: $urlBase");
    }

    public static function registrar_libro_insert()
    {
        $nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : "";
        $descripcion = isset($_REQUEST["desc"]) ? $_REQUEST["desc"] : "";
        $autor = isset($_REQUEST["autor"]) ? $_REQUEST["autor"] : "";
        $fecha_publicacion = date("Y-m-d");
        $stock = isset($_REQUEST["stock"]) ? $_REQUEST["stock"] : "";
        $generos = isset($_REQUEST["nombre"]) ? $_REQUEST["generos"] : "";
        if ($nombre !== "" && $descripcion !== "" && $autor !== "" && $stock !== "" && $generos !== "") {
            $answ = servicio_admin::insert_book($nombre, $descripcion, $fecha_publicacion, $stock, ucwords(strtolower($autor)), $generos);
            if ($answ[1]) {
                $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/insert_libro.php";
                header("Location: $urlBase?msj=$answ[2]");
                exit();
            } else {
                $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php";
                header("Location: $urlBase?msj=$answ[2]");
                exit();
            }
        } else {
            $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php";
            header("Location: $urlBase?msj=todos los campos deben estar llenos para continuar");
            exit();
        }
    }
    public static function libro_delete()
    {
        $id = isset($_REQUEST["id_libro"]) ? $_REQUEST["id_libro"] : "";
        if ($id !== "") {
            $answ = servicio_admin::delete_book($id);
            if ($answ[1]) {
                $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/index_admin.php";
                header("Location: $urlBase?msj=$answ[2]");
                exit();
            } else {
                $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php";
                header("Location: $urlBase?msj=$answ[2]");
                exit();
            }
        }
    }
    public static function libro_Edit()
    {
        $id_libro = isset($_REQUEST["id_libro"]) ? $_REQUEST["id_libro"] : "";
        if ($id_libro != "") {
            $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/edit_libro.php";
            header("Location: $urlBase?id_libro=$id_libro");
            exit();
        } else {
            $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php";
            header("Location: $urlBase?msj=Seleccione un libro valido");
            exit();
        }
    }

    public static function libro_Edit_insert()
    {
        $id_libro = isset($_REQUEST["id_libro"]) ? $_REQUEST["id_libro"] : "";
        $nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : "";
        $descripcion = isset($_REQUEST["desc"]) ? $_REQUEST["desc"] : "";
        $autor = isset($_REQUEST["autor"]) ? $_REQUEST["autor"] : "";
        $stock = isset($_REQUEST["stock"]) ? $_REQUEST["stock"] : "";
        $generos = isset($_REQUEST["nombre"]) ? $_REQUEST["generos"] : "";
        if ($id_libro !== "" && $nombre !== "" && $descripcion !== "" && $autor !== "" && $stock !== "" && $generos !== "") {
            $answs = servicio_admin::edit_book($id_libro, $nombre, $descripcion, $stock, ucwords(strtolower($autor)), $generos);
            if ($answs[1]) {
                $urlBase = $_SERVER['HTTP_REFERER'];
                header("Location: $urlBase");
                exit();
            } else {
                $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php";
                header("Location: $urlBase?msj=$answs[2]");
                exit();
            }
        } else {
            $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php";
            header("Location: $urlBase?msj=todos los campos deben estar llenos para continuar");
            exit();
        }
    }

}

Index_adminController::ejecutarAccion();
