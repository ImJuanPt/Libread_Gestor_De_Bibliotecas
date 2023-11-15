<?php
interface IPrestamoCrud
{
   public static function findPrestamo($id_prestamo);
   public static function createPrestamo($id_libro, $id_usuario);
   public static function dateActuc();
   public static function dateActuc3day();
}