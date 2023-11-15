<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Libro/ILibroCrud.php";

class LibroCrud implements ILibroCrud
{
    public static function find_book($id_libro)
    {
        try {
            $lib = Libro::find('all', array(
                'joins' => array('autores'),
                'select' => 'libros.*, autores.nombre_autor, libros.img_portada',
                'conditions' => 'estado_libro = "ACTIVO" AND id_libro =' . $id_libro . ';',
            ));
            return $lib[0];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public static function listAllBooks()
    {
        try {
            $list = Libro::find('all', array(
                'joins' => array('autores'),
                'select' => 'libros.*, autores.nombre_autor, libros.img_portada',
                'conditions' => 'estado_libro = "ACTIVO"',
            ));
            return $list;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function listSearchBooks($opcion, $busqueda)
    {

        $lib = Libro::find('all', array(
            'joins' => array('autores'),
            'select' => 'libros.*, autores.nombre_autor, libros.img_portada',
            'conditions' => "$opcion LIKE '%$busqueda%' AND estado_libro = 'ACTIVO'",
        ));
        return $lib;
    }
    public static function createBook($nombre, $descripcion, $fecha_publicacion, $stock, $nombreAutor, $generos, $ruta_portada)
    {
        try {
            $libro_nuevo = Libro::create([
                'nombre' => $nombre, 'descripcion' => $descripcion, 'fecha_publicacion' => $fecha_publicacion,
                'id_autor' => $nombreAutor->id_autor, 'stock' => $stock, 'img_portada' => $ruta_portada
            ]);
            return $libro_nuevo;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function deleteBook($id_libro)
    {
        try {
            $lib = LibroCrud::find_book($id_libro);
            $lib->estado_libro = "INACTIVO";
            $lib->save();
            return $lib;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function editBook($id_libro, $nombre, $descripcion, $stock, $id_autor, $generos)
    {
        try {
            $lib = self::find_book($id_libro);
            $lib->nombre = $nombre;
            $lib->descripcion = $descripcion;
            $lib->stock = $stock;
            $lib->id_autor = $id_autor;
            $lib->save();
            return $lib;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public static function countBook()
    {
        return Libro::count();
    }
}
