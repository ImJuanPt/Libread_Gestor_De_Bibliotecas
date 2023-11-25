<?php
interface IGeneroCrud
{
    public static function createGenero($id_libro, $id_genero);
    public static function list_gender();
    public static function list_gender_on_book($id_libro);
    public static function gender_book($id);
}
