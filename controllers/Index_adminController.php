<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Prestamo.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_admin.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Libro.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Prestamo.php";

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
            case "Solicitar_prestamo":
                Index_adminController::solicitar_prestamo();
                break;
            case "validar_prestamo":
                Index_adminController::validar_prestamo();
                break;
            case "confirmar_prestamo":
                Index_adminController::confirmar_prestamo();
                break;
            case "lista_prestamos":
                Index_adminController::lista_prestamos();
                break;
            case "confirmar_entrega":
                Index_adminController::confirmar_entrega();
                break;
            default:
                header("Location:../view/error.php?msj=Accion no permitida $accion");
                exit;
        }
    }

    public static function Perfil()
    {
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/profile.php";
        header("Location: $urlBase");
        exit;
    }
    public static function Perfil_edit()
    {
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/profile_editar.php";
        header("Location: $urlBase");
        exit;
    }
    public static function index_admin()
    {
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/index_admin.php";
        header("Location: $urlBase");
        exit;
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
    public static function solicitar_prestamo()
    {
        $id_libro = isset($_REQUEST["id_libro"]) ? $_REQUEST["id_libro"] : "";
        try {
            if ($id_libro != "") {
                service_Prestamo::select_solic_prest_libro($id_libro);
                $resp = unserialize($_SESSION["prestamo.libro"]);
                if ($resp instanceof Libro) {
                    $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/view_prestamo/solicitar_prestamo.php";
                    header("Location: $urlBase");
                    exit();
                } else {
                    throw new Exception($resp);
                }
            } else {
                throw new Exception("Todos los campos deben estar llenos para continuar");
            }
        } catch (Exception $e) {
            $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php";
            header("Location: $urlBase?msj=" . $e->getMessage());
            exit();
        }
    }
    public static function validar_prestamo()
    {
        $id_usuario = isset($_REQUEST["cedula_solicitante"]) ? $_REQUEST["cedula_solicitante"] : "";
        try {
            if ($id_usuario != "") {
                service_Prestamo::select_solic_prest_usuario($id_usuario);
                $resp = unserialize($_SESSION["prestamo.usuario"]);
                if ($resp instanceof Usuario) {
                    $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/view_prestamo/validar_prestamo.php";
                    header("Location: $urlBase");
                    exit();
                } else {
                    throw new Exception($resp);
                }
            } else {
                throw new Exception("Todos los campos deben estar llenos para continuar");
            }
        } catch (Exception $e) {
            $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php";
            header("Location: $urlBase?msj=" . $e->getMessage());
            exit();
        }
    }

    public static function confirmar_prestamo()
    {
        service_Prestamo::confirmar_prestamo();
        $answ = unserialize($_SESSION["prestamo.respuesta"]);

        if ($answ[0]) {
            $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/index_admin.php";
            header("Location: $urlBase?msj=$answ[1]");
            exit;
        } else {
            $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php";
            header("Location: $urlBase?msj=$answ[1]");
            exit();
        }
    }

    public static function lista_prestamos()
    {
        $id_libro = isset($_REQUEST["id_libro"]) ? $_REQUEST["id_libro"] : "";
        try {
            if ($id_libro != "") {
                service_Prestamo::list_prest($id_libro);
                $resp = unserialize($_SESSION["prestamo.respuesta"]);
                if ($resp[0]) {
                    $_SESSION['lista.prestamos'] = serialize($resp[1]);
                    $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/view_entrega/lista_prestamos.php";
                    header("Location: $urlBase");
                    exit();
                } else {
                    throw new Exception($resp);
                }
            } else {
                throw new Exception("Todos los campos deben estar llenos para continuar");
            }
        } catch (Exception $e) {
            $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php";
            header("Location: $urlBase?msj=" . $e->getMessage());
            exit();
        }
    }

    public static function confirmar_entrega()
    {
        $id_prestamo = isset($_REQUEST["id_prestamo"]) ? $_REQUEST["id_prestamo"] : "";
        if ($id_prestamo != "") {
            $resp = servicio_admin::confirm_entrega($id_prestamo);
            if ($resp[0]) {
                $urlBase = $_SERVER['HTTP_REFERER'];
                header("Location: $urlBase");
                exit();
            } else {
                $urlBase = $_SERVER['HTTP_REFERER'];
                //header("Location: $urlBase");
                //exit();
            }
        } else {
            $urlBase = $_SERVER['HTTP_REFERER'];
            //header("Location: $urlBase");
            //exit();
        }
    }
}

Index_adminController::ejecutarAccion();
