<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Prestamo/PrestamoCrud.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/services/service_Libro.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/services/service_Usuario.php";

class service_Prestamo
{
    public static function select_solic_prest_libro($id_libro)
    {
        try {
            $libro = service_Libro::find_book($id_libro);
            if ($libro instanceof Libro) {
                $_SESSION["prestamo.libro"] = serialize($libro);
            } else {
                throw new Exception("El libro seleccionado no existe");
            }
        } catch (Exception $e) {
            $_SESSION["prestamo.libro"] = serialize("Ocurrio un error: " . $e->getMessage());
        }
    }
    public static function select_solic_prest_usuario($id_usuario)
    {
        $usuario = service_Usuario::findUser($id_usuario);
        try {
            if ($usuario instanceof Usuario) {
                $_SESSION["prestamo.usuario"] = serialize($usuario);
            } else {
                throw new Exception($usuario);
            }
        } catch (Exception $e) {
            $_SESSION["prestamo.usuario"] = serialize("Ocurrio un error: " . $e->getMessage());
        }
    }

    public static function findPrestamos($id_libro)
    {
        return PrestamoCrud::findPrestamos($id_libro);
    }
    public static function findPrestamoUser($cc_usuario, $estado){
        return PrestamoCrud::findPrestamoUser($cc_usuario, $estado);
    }

    public static function verify_user_have_book($id_user, $id_libro)
    {
        $lista_prestamos = self::findPrestamos($id_libro);
        foreach ($lista_prestamos as $prestamo) {
            if ($prestamo['cedula'] == $id_user && $prestamo['estado_prestamo'] == "NO ENTREGADO") {
                return true;
            }
        }
        return false;
    }

    public static function confirmar_prestamo()
    {
        try {
            $user = unserialize($_SESSION['prestamo.usuario']);
            $book = unserialize($_SESSION['prestamo.libro']);
            $array_respuesta = array();
            if ($user instanceof Usuario) {
                if ($book instanceof Libro) {
                    if ($user->prestamos_activos < 5) {
                        if ($user->puntaje > 0) {
                            if (!self::verify_user_have_book($user->cedula, $book->id_libro)) {
                                $prestamo = PrestamoCrud::createPrestamo($book->id_libro, $user->cedula);
                                if (!$prestamo instanceof Prestamo) {
                                    throw new Exception($prestamo);
                                }
                                $user = UsuarioCrud::addPrestamoUser($user);
                                if (!$user instanceof Usuario) {
                                    throw new Exception($user);
                                }
                                $array_respuesta[0] = true;
                                $array_respuesta[1] = "Presamo registrado con exito";
                            } else {
                                throw new Exception("El usuario ya tiene en un prestamo activo con el libro que solicita");
                            }
                        } else {
                            throw new Exception("El usuario ha sido penalizado por mal comportamiento, por tal motivo no se puede realizar el prestamo");
                        }
                    } else {
                        throw new Exception("El usuario ha alcanzado los prestamos maximos");
                    }
                } else {
                    throw new Exception("Hubo un error con el libro para realizar el prestamo");
                }
            } else {
                throw new Exception("Hubo un error con el usuario para realizar el prestamo");
            }
            $_SESSION["prestamo.respuesta"] = serialize($array_respuesta);
        } catch (Exception $e) {
            $array_respuesta[0] = false;
            $array_respuesta[1] = "Hubo un error inesperado: " . $e->getMessage();
            $_SESSION["prestamo.respuesta"] = serialize($array_respuesta);
        }
    }

    public static function list_prest($id_libro)
    {
        $array_respuesta = array();
        try {
            $list = self::findPrestamos($id_libro);
            $data = $list->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($data) || $data == null) {
                $array_respuesta[0] = true;
                $array_respuesta[1] = $data;
                $_SESSION["prestamo.respuesta"] = serialize($array_respuesta);
                return $data;
            } else {
                throw new Exception($list);
            }
        } catch (Exception $e) {
            $_SESSION["prestamo.respuesta"] = null;
        }
    }
    public static function list_prest_busqueda($id_libro, $tipo, $valor)
    {
        $array_respuesta = array();
        try {
            $list = PrestamoCrud::findPrestamo_search($id_libro, $tipo, $valor);
            $data = $list->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($data) || $data == null) {
                $array_respuesta[0] = true;
                $array_respuesta[1] = $data;
                $_SESSION["prestamo.respuesta.busqueda"] = serialize($array_respuesta);
            } else {
                throw new Exception($list);
            }
        } catch (Exception $e) {
            $_SESSION["prestamo.respuesta.busqueda"] = null;
        }
    }

    public static function select_dates()
    {
        try {
            $fechas = array();

            $temp = PrestamoCrud::dateActuc();
            $fechas[0] = $temp[0]->fecha;

            $temp = PrestamoCrud::dateActuc3day();
            $fechas[1] = $temp[0]->fecha_3;

            return $fechas;
        } catch (Exception $e) {
            return null;
        }
    }
    public static function confirm_entrega($id_prestamo)
    {
        $array_respuesta = array();
        $prestamo = PrestamoCrud::findUniqPrestamo($id_prestamo);
        $u = service_Usuario::findUser($prestamo->cc_usuario);
        if ($prestamo) {
            $fecha_entrega = strtotime(date("d-m-Y H:i:00", time()));
            $fecha_max_devolucion = strtotime($prestamo->fecha_max_devolucion);
            if ($fecha_entrega > $fecha_max_devolucion) {
                $u->puntaje = $u->puntaje - 1;
                $array_respuesta[2] = "El usuario excedio la fecha maxima de entrega y por ende sera penalziado";
            }
            $u->prestamos_activos = $u->prestamos_activos - 1;
            service_Usuario::saveUser($u);

            $prestamo->estado_prestamo = "ENTREGADO";
            $prestamo->fecha_entrega = $fecha_entrega;
            PrestamoCrud::editPrestamo($prestamo);
            $lista = self::list_prest($prestamo->id_libro);
            $_SESSION['lista.prestamos'] = serialize($lista);
            $array_respuesta[0] = true;
            $array_respuesta[1] = "El libro fue entregado con exito";
        } else {
            $array_respuesta[0] = false;
            $array_respuesta[1] = "El prestamo enviado no se encuentra registrado";
        }
        return $array_respuesta;
    }
}
