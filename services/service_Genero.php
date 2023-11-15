<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Genero.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/LibrosGenero.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Genero/GeneroCrud.php";

class service_Genero
{
    public static function createGenero($id_libro, $id_genero){
        return GeneroCrud::createGenero($id_libro, $id_genero);
    }
}