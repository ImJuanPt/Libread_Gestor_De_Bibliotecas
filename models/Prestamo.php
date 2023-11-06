<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/Libread_Gestor_De_Bibliotecas/lib/config.php";

class Prestamo extends ActiveRecord\model{
    public static $belongs_to = array(
        array('usuarios', 'class_name' => 'Usuario', 'foreign_key' => 'cedula'),
        array('libros', 'class_name' => 'Libro', 'foreign_key' => 'id_libro'),
        array('autores', 'class_name' => 'Autor', 'foreign_key' => 'id_autor')
    );

}