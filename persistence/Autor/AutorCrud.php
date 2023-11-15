<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/models/Anuncio.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Autor/IAutorCrud.php";

class AutorCrud implements IAutorCrud
{
    public static function createAutor($nombreAutor)
    {
        try {
            $autor = Autor::create(['nombre_autor' => $nombreAutor]);
            return $autor;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public static function findAutorByName($nombreAutor)
    {
        try {
            return Autor::find('all', array('conditions' => array('nombre_autor = ?', $nombreAutor)));
        } catch (Exception $e) {
            return "Ocurrio un error: " . $e->getMessage();
        }
    }
    public static function findAUtorById($id_autor)
    {
        try {
            $autor =  Autor::find_by_pk($id_autor);
            return $autor;
        } catch (Exception $e) {
            return "Ocurrio un error: " . $e->getMessage();
        }
    }
}
