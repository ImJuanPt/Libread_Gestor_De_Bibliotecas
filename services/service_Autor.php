<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Anuncio.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Autor/AutorCrud.php";

class service_Autor
{
    public static function verify_exist_autor($nombreAutor)
    {
        try {
            $existeAutor = AutorCrud::findAutorByName($nombreAutor);
            if (empty($existeAutor)) {
                // Insertar el autor solo si no existe
                $nombreAutor = AutorCrud::createAutor($nombreAutor);
                if (!$nombreAutor instanceof Autor) {
                    throw new Exception("Hubo un error al intentar registrar al autor");
                }
            } else {
                if (!$existeAutor instanceof String) {
                    $nombreAutor = $existeAutor[0];
                } else {
                    throw new Exception("Hubo un error al intentar registrar al autor");
                }
            }
            return $nombreAutor;
        } catch (Exception $e) {
            return "Ocurrio un error: ".$e->getMessage();
        }
    }
    public static function findAutor($id_autor){
        return AutorCrud::findAUtorById($id_autor);
    }
}
