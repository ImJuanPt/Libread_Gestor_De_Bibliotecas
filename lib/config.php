<?php
require_once 'php-activerecord/ActiveRecord.php';

ActiveRecord\Config::initialize(function($cfg) {
    $cfg->set_model_directory($_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models");
    $cfg->set_connections(array(
        'development' => 'mysql://root:@localhost/db_gestor_bibliotecas?charset=utf8mb4'
    ));
    $cfg->set_default_connection('development');
});
