<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/Libread_Gestor_De_Bibliotecas/lib/config.php";

class LibrosGenero extends ActiveRecord\Model{
    static $belongs_to = array(
        array('libro'),
        array('generos', 'class_name' => 'Genero', 'foreign_key' => 'id_genero')
    );
}
?>

