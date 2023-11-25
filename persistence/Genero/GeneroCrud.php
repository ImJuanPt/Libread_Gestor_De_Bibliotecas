<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/models/Anuncio.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Genero/IGeneroCrud.php";

class GeneroCrud implements IGeneroCrud
{
    public static function createGenero($id_libro, $id_genero)
    {
        try {
            $genero = LibrosGenero::create([
                'id_libro' => $id_libro, 'id_genero' => $id_genero
            ]);
            return $genero;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public static function list_gender() 
    {
        $g = Genero::all();
        return $g;
    }

    public static function list_gender_on_book($id_libro)
    {
        $list = LibrosGenero::find('all', array(
            'joins' => array('generos'),
            'select' => 'libros_generos.*, generos.*',
            'conditions' => 'id_libro = "' . $id_libro . '"'
        ));
        return $list;
    }
    public static function gender_book($id)
    {
        $row_genero = LibrosGenero::query("SELECT generos.nombre_genero 
        FROM libros_generos 
        INNER JOIN generos ON libros_generos.id_genero = generos.id_genero 
        WHERE libros_generos.id_libro = '$id'");
        return $row_genero;
    }
}
