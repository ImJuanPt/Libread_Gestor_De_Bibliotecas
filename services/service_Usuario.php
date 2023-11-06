<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/UsuarioCrud.php";
class service_Usuario
{
    public static function register($cedula, $clave, $apellido1, $apellido2, $correo, $nombre)
    {
        $array_respuesta = array();
        $user = new Usuario();
        $user->cedula = $cedula;
        $user->passw = $clave;
        $user->apellido_1 = $apellido1;
        $user->apellido_2 = $apellido2;
        $user->correo = $correo;
        $user->nombre = $nombre;
        try {
            if (!UsuarioCrud::findUser($cedula)) {
                $user->save();
                $array_respuesta[1] = true;
                $array_respuesta[2] = "Registro Exitoso";
            } else {
                $array_respuesta[1] = false;
                $array_respuesta[2] = "Hubo un error, la cedula que intenta ingresar ya se encuentra registrada, intente Iniciar Sesion";
            }
            return $array_respuesta;
        } catch (Exception $error) {
            $array_respuesta[1] = false;
            $array_respuesta[2] = "Hubo un error al intentar registrar el usuario: " . $error->getMessage();
            return $array_respuesta;
        }
    }

    public static function login($cedula, $clave)
    {
        $array_respuesta = array();
        try {
            $u = UsuarioCrud::findUser($cedula);
            if ($u instanceof Usuario) {
                if ($u->clave == $clave) {
                    $u = serialize($u);
                    $_SESSION["usuario.login"] = $u;
                    $array_respuesta[1] = true;
                    $array_respuesta[2] = "Inicio de Sesion exitoso";
                    $_SESSION["login.respuesta"] = serialize($array_respuesta);
                } else {
                    throw new Exception("Password Incorrecto");
                }
            } else {
                throw new Exception($u);
            }
        } catch (Exception $error) {
            $msj = "Ocurrio un error al Iniciar Sesion: " . $error->getMessage();
            $_SESSION["usuario.login"] = NULL;
            $array_respuesta[1] = false;
            $array_respuesta[2] = $msj;
            $_SESSION["login.respuesta"] = serialize($array_respuesta);
        }
    }

    public static function validate_login()
    {
        $user = unserialize(isset($_SESSION["usuario.login"])?$_SESSION["usuario.login"]:null);
        if ($user != null) {
            return $user;
        } else {
            return false;
        }
    }

    public static function Logout()
    {
        $_SESSION["usuario.login"] = null;
    }

   
}
