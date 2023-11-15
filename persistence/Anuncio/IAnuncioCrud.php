<?php
interface IAnuncioCurd
{
    public static function findAnunces();
    public static function createAnunce($id_libro, $nombre, $tipo_anuncio);
}
