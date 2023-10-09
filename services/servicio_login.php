<?php
class servicio_login
{
    public static function login($cedula, $clave)
    {
        $array_respuesta = array();
        try {
            $u = Usuario::find($cedula);
            if ($u->clave == $clave) {
                $u = serialize($u);
                $_SESSION["usuario.login"] = $u;
                $array_respuesta[1] = true;
                $array_respuesta[2] = "Inicio de Sesion exitoso";
            } else {
                $_SESSION["usuario.login"] = null;
                $array_respuesta[1] = false;
                $array_respuesta[2] = "Password Incorrecto";
            }
            return $array_respuesta;
        } catch (Exception $error) {
            if (strstr($error->getMessage(), $cedula)) {
                $msj = "El usuario con Cedula: $cedula no existe";
            } else {
                $msj = "Ocurrio un error al Iniciar Sesion: " . $error->getMessage();
            }
            $_SESSION["usuario.find"] = NULL;
            $array_respuesta[1] = false;
            $array_respuesta[2] = $msj;
            return $array_respuesta;
        }
    }

    public static function register($user)
    {
        $array_respuesta = array();
        try {
            if (!Usuario::find_by_pk($user->cedula)) {
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
            $array_respuesta[2] = "Hubo un error al intentar registrar el usuario: ". $error->getMessage();
            return $array_respuesta;
        }
    }

    public static function Logout()
    {
        $_SESSION["usuario.login"] = null;
    }

    public static function validate_login()
    {
        if (isset($_SESSION["usuario.login"])) {
            return unserialize($_SESSION["usuario.login"]);
        }
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/login.php";
        //verificar si la ruta actual es distinta a la que se redirije si no se ha iniciado sesion, sino entra en buqle
        if ($_SERVER['PHP_SELF'] != "/Libread_Gestor_De_Bibliotecas/view/login.php") {
            header("Location: $urlBase");
            exit;
        }
    }
}
