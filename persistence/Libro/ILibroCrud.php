<?php
interface ILibroCrud
{
    public static function listAllBooks();
    public static function listSearchBooks($opcion, $busqueda);
    public static function find_book($id_libro);
    public static function createBook($nombre, $descripcion, $fecha_publicacion, $stock, $nombreAutor, $generos, $ruta_portada);
    public static function deleteBook($id_libro);
    public static function editBook($id_libro, $nombre, $descripcion, $stock, $nombreAutor, $generos);
    public static function countBook();

}
