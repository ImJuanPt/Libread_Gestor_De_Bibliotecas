<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Genero.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/LibrosGenero.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Genero/GeneroCrud.php";

class service_Genero
{
    public static function createGenero($id_libro, $id_genero){
        return GeneroCrud::createGenero($id_libro, $id_genero);
    }

    public static function list_gender() #CREAR EN SERIVICIO GENEROSSSSSSS ----------------------------------------------------------
    {
        return GeneroCrud::list_gender();
    }
    public static function list_gender_on_book($id_libro)
    {
        $genero_nombres = [];
        $list = GeneroCrud::list_gender_on_book($id_libro);
        foreach ($list as $genero) {
            $genero_nombres[] = $genero->nombre_genero;
        }
        return $genero_nombres;
    }
    public static function gender_book($id)
    {
        $row_genero = GeneroCrud::gender_book($id);
        $generos = '';
        foreach ($row_genero as $row_genero) {
            if ($generos === '') {
                $generos = $row_genero['nombre_genero'];
            } else {
                $generos = $generos . ", " . $row_genero['nombre_genero'];
            }
        }
        return $generos;
    }
}