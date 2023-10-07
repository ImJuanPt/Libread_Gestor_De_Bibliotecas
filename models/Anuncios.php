<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/Libread_Gestor_De_Bibliotecas/lib/config.php";

class Anuncio extends ActiveRecord\Model{
    public static $primary_key = "id_anuncio";
    public static $belongs_to = array(
        array("libro") // Un anuncio pertence a un libro
    );
}
?>

