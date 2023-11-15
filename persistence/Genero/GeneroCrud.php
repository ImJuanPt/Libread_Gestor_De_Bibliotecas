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
}
