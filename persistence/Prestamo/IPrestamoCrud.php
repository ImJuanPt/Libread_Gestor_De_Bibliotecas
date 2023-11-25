<?php
interface IPrestamoCrud
{
   public static function findPrestamos($id_prestamo);
   public static function findUniqPrestamo($id_prestamo);
   public static function findPrestamoUser($cc_usuario, $estado);
   public static function createPrestamo($id_libro, $id_usuario);
   public static function dateActuc();
   public static function dateActuc3day();
   public static function editPrestamo($prestamo);
}