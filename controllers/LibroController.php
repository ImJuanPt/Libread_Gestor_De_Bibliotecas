<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Libro.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Prestamo.php";

class LibroController
{

    public static function ejecutarAccion()
    {
        $accion = $_REQUEST["accion"];
        switch ($accion) {
            case "registrar_libro":
                self::registrar_libro();
                break;
            case "registrar_libro_insert":
                self::registrar_libro_insert();
                break;
            case "Eliminar":
                self::libro_delete();
                break;
            case "Editar":
                self::libro_Edit();
                break;
            case "Editar_insert":
                self::libro_Edit_insert();
                break;
            case "listado_libros_usuario":
                header("Location:../view/view_user/listado_libros.php");
                exit;
            default:
                header("Location:../view/error.php?msj=Accion no permitida $accion");
                exit;
        }
    }


    public static function registrar_libro()
    {
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/insert_libro.php";
        header("Location: $urlBase");
        exit;
    }

    public static function registrar_libro_insert()
    {
        $nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : "";
        $descripcion = isset($_REQUEST["desc"]) ? $_REQUEST["desc"] : "";
        $autor = isset($_REQUEST["autor"]) ? $_REQUEST["autor"] : "";
        $fecha_publicacion = date("Y-m-d");
        $stock = isset($_REQUEST["stock"]) ? $_REQUEST["stock"] : "";
        $generos = isset($_REQUEST["nombre"]) ? $_REQUEST["generos"] : "";
        try {
            if ($nombre !== "" && $descripcion !== "" && $autor !== "" && $stock !== "" && $generos !== "") {
                service_Libro::insert_book($nombre, $descripcion, $fecha_publicacion, $stock, ucwords(strtolower($autor)), $generos);
                if (isset($_SESSION["libro.respuesta"])) {
                    $answ =  unserialize($_SESSION["libro.respuesta"]);
                } else {
                    throw new Exception("Error en sesion");
                }

                if ($answ[1]) {
                    $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/insert_libro.php";
                    header("Location: $urlBase?msj=$answ[2]");
                    exit();
                } else {
                    throw new Exception($answ[2]);
                }
            } else {
                throw new Exception("todos los campos deben estar llenos para continuar");
            }
        } catch (Exception $e) {
            $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php";
            header("Location: $urlBase?msj=" . $e->getMessage());
            exit();
        }
    }
    public static function libro_delete()
    {
        $id = isset($_REQUEST["id_libro"]) ? $_REQUEST["id_libro"] : "";
        try {
            if ($id !== "") {
                service_Libro::delete_book($id);
                if (isset($_SESSION["libro.respuesta"])) {
                    $answ =  unserialize($_SESSION["libro.respuesta"]);
                } else {
                    throw new Exception("Error en sesion");
                }
                if ($answ[1]) {
                    $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/index_admin.php";
                    header("Location: $urlBase?msj=$answ[2]");
                    exit();
                } else {
                    throw new Exception($answ[2]);
                }
            } else {
                throw new Exception("Error en la trasnferencia de datos");
            }
        } catch (Exception $e) {
            $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php";
            header("Location: $urlBase?msj=" . $e->getMessage());
            exit();
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
            service_Libro::edit_book($id_libro, $nombre, $descripcion, $stock, ucwords(strtolower($autor)), $generos);
            if (isset($_SESSION["libro.respuesta"])) {
                $answs =  unserialize($_SESSION["libro.respuesta"]);
            } else {
                throw new Exception("Error en sesion");
            }
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

LibroController::ejecutarAccion();
