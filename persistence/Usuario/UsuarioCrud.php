<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Usuario/IUsuarioCrud.php";

class UsuarioCrud implements IUsuarioCrud
{
    public static function findUser($cedula)
    {
        try {
            $u = Usuario::find(array('cedula' => $cedula));
            if ($u == null) {
                throw new Exception("No existe el usuario");
            }
            return $u;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function registerUser($cedula, $clave, $apellido1, $apellido2, $correo, $nombre)
    {
        try {
            $user = Usuario::create([
                'cedula' => $cedula,
                'passw' => $clave,
                'apellido_1' => $apellido1,
                'apellido_2' => $apellido2,
                'correo' => $correo,
                'nombre' => $nombre,
            ]);
            return $user;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function editUser($nombre, $apellido1, $apellido2, $pass, $correo, $cc, $perfil_edit)
    {
        try {
            $perfil_edit->passw = $pass;
            $perfil_edit->nombre = $nombre;
            $perfil_edit->apellido_1 = $apellido1;
            $perfil_edit->apellido_2 = $apellido2;
            $perfil_edit->correo = $correo;
            $perfil_edit->save();
            return $perfil_edit;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function deleteUser($cedula)
    {
    }

    public static function login($cedula, $clave)
    {
    }

    public static function addPrestamoUser($user)
    {
        try{
            $user->prestamos_activos++;
            $user->save();
            return $user;
        }catch(Exception $e){
            return $e->getMessage();
        }
        
    }
}
