<?php
@session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
class servicio_profileEdit
{
    public static function edit_profile($nombre, $apellido1, $apellido2, $pass, $correo, $cc)
    {
        $array_respuesta = array();
        $u = $_SESSION["usuario.login"];
        $u = @unserialize($u);

        @$u->passw = $pass;
        @$u->nombre = $nombre;
        @$u->apellido_1 = $apellido1;
        @$u->apellido_2 = $apellido2;
        @$u->correo = $correo;

        try {
            @$u->save();
            @$_SESSION["usuario.login"] = serialize($u);
            @$array_respuesta[1] = true;
            @$array_respuesta[2] = "Usuario Editado";
            return $array_respuesta;
        } catch (Exception $error) {
            if (strstr($error->getMessage(), $cc)) {
                $msj = "El usuario con Cedula: $cc no existe";
            } else {
                $msj = "Ocurrio un error al editar el Usuario";
            }
            $array_respuesta[1] = false;
            $array_respuesta[2] = $msj;
            return $array_respuesta;
        }
    }
}
