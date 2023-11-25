<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Libro.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Prestamo.php";

class PrestamoController
{

    public static function ejecutarAccion()
    {
        $accion = @$_REQUEST["accion"];
        switch ($accion) {
            
            case "Solicitar_prestamo":
                self::solicitar_prestamo();
                break;
            case "validar_prestamo":
                self::validar_prestamo();
                break;
            case "confirmar_prestamo":
                self::confirmar_prestamo();
                break;
            case "lista_prestamos":
                self::lista_prestamos();
                break;
            case "busqueda_prestamos":
                self::lista_prestamos_busqueda();
                break;
            case "confirmar_entrega":
                self::confirmar_entrega();
                break;
            case "prestamos_usuario":
                header("Location: ../view/view_user/prestamos.php");
                break;
            case "devoluciones_usuario":
                header("Location: ../view/view_user/devoluciones.php");
                break;
            default:
                header("Location:../view/error.php?msj=Accion no permitida $accion");
                exit;
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
                    $_SESSION['libro.prestamo.select'] = serialize($id_libro);
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
    public static function lista_prestamos_busqueda()
    {

        $opcion = isset($_REQUEST["opcion_busqueda"]) ? $_REQUEST["opcion_busqueda"] : "";
        $valor = isset($_REQUEST["texto_busqueda"]) ? $_REQUEST["texto_busqueda"] : "";
        $id_libro = unserialize( $_SESSION['libro.prestamo.select']);
        try {
            if ($id_libro != "") {
                service_Prestamo::list_prest_busqueda($id_libro, $opcion, $valor);
                $resp = unserialize($_SESSION["prestamo.respuesta.busqueda"]);
                if ($resp[0]) {
                    $_SESSION['lista.prestamos.busqueda'] = serialize($resp[1]);
                    $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/view_admin/view_entrega/lista_prestamos_busqueda.php";
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
            $resp = service_Prestamo::confirm_entrega($id_prestamo);
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

PrestamoController::ejecutarAccion();
