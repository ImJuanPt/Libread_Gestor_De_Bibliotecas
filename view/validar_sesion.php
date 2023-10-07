<?php
@session_start();
$u = @$_SESSION["usuario.login"];
$u = @unserialize($u);
if(!$u){
    $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']."/Libread_Gestor_De_Bibliotecas/view/login.php";
    header("Location: $urlBase");
    exit;
}

?>