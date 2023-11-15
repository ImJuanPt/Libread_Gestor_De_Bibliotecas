<?php
interface IAutorCrud
{
    public static function createAutor($nombreAutor);
    public static function findAutorByName($nombreAutor);
    public static function findAUtorById($id_autor);
}
