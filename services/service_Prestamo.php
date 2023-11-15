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
            $list = PrestamoCrud::findPrestamo($id_libro);
            $data = $list->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($data) || $data == null) {
                $array_respuesta[0] = true;
                $array_respuesta[1] = $data;
                $_SESSION["prestamo.respuesta"] = serialize($array_respuesta);
            } else {
                throw new Exception($list);
            }
        } catch (Exception $e) {
            $_SESSION["prestamo.respuesta"] = null;
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
}
