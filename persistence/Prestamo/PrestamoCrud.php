<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/models/Prestamo.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Prestamo/IPrestamoCrud.php";

class PrestamoCrud implements IPrestamoCrud
{

    public static function editPrestamo($prestamo){
        try{
            $prestamo->save();
            return $prestamo;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    public static function findUniqPrestamo($id_prestamo)
    {
        return Prestamo::find_by_pk($id_prestamo);
    }
    public static function findPrestamos($id_libro)
    {
        try {
            return Prestamo::query("SELECT *,usuarios.nombre AS nombre_usuario, usuarios.cedula , libros.nombre AS nombre_libro, autores.nombre_autor FROM prestamos 
            INNER JOIN libros ON prestamos.id_libro = libros.id_libro
            INNER JOIN autores ON libros.id_autor = autores.id_autor
            INNER JOIN usuarios ON prestamos.cc_usuario = usuarios.cedula
            WHERE libros.id_libro = $id_libro");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function findPrestamoUser($cc_usuario, $estado){
        return Prestamo::query("SELECT usuarios.*, prestamos.*, libros.*
        FROM usuarios 
        INNER JOIN prestamos ON usuarios.cedula = prestamos.cc_usuario
        INNER JOIN libros ON prestamos.id_libro = libros.id_libro
        WHERE usuarios.cedula = $cc_usuario AND prestamos.estado_prestamo = '$estado';");
    }
    public static function findPrestamo_search($id_libro, $tipo, $valor)
    {
        try {
            return Prestamo::query("SELECT *, usuarios.nombre AS nombre_usuario, usuarios.cedula, libros.nombre AS nombre_libro, autores.nombre_autor
            FROM prestamos
            INNER JOIN libros ON prestamos.id_libro = libros.id_libro
            INNER JOIN autores ON libros.id_autor = autores.id_autor
            INNER JOIN usuarios ON prestamos.cc_usuario = usuarios.cedula
            WHERE libros.id_libro = $id_libro AND usuarios.$tipo LIKE '$valor%'");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function createPrestamo($id_libro, $id_usuario)
    {
        try {
            return Prestamo::create([
                'id_libro' => $id_libro, 'cc_usuario' => $id_usuario
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function dateActuc()
    {
        try {
            return Prestamo::find_by_sql("SELECT DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i') AS fecha;");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public static function dateActuc3day()
    {
        try {
            return Prestamo::find_by_sql("SELECT DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 3 DAY), '%Y-%m-%d %H:%i') AS fecha_3;");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
