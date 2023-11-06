<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/LibrosGenero.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Genero.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Anuncio.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Libro.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_index.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_login.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_admin.php";
class servicio_admin
{
    //metodo para listar todos los libros y retornar el array que se genera
    public static function list_books()
    {
        return Libro::find('all', array(
            'joins' => array('autores'),
            'select' => 'libros.*, autores.nombre_autor, libros.img_portada',
            'conditions' => 'estado_libro = "ACTIVO"',
        ));
    }

    //buscar un libro especifico y retornarlo
    public static function find_book($id)
    {

        $lib = Libro::find('all', array(
            'joins' => array('autores'),
            'select' => 'libros.*, autores.nombre_autor, libros.img_portada',
            'conditions' => 'estado_libro = "ACTIVO" AND id_libro =' . $id . ';',
        ));

        return $lib ? $lib : false;
    }

    public static function find_autor($id_autor)
    {
        return Autor::find_by_pk($id_autor);
    }

    //buscar los generos de un libro especifico(no funcionando)
    public static function gender_book($id)
    {
        /*
        $row_genero = LibrosGenero::find('all', array(
            'joins' => array('generos'),
            'select' => 'libros.*, autores.nombre_autor, libros.img_portada',
            'conditions' => 'libros_generos.id_libro =' . $id . ';',
        ));

        $generos = '';
        foreach($row_genero as $row_genero){
            if($generos===''){
                $generos = $row_genero['nombre_genero'];
            }else{
                $generos = $generos.", ".$row_genero['nombre_genero'];
            }
        }
        return $generos;
        */

        $row_genero = LibrosGenero::query("SELECT generos.nombre_genero 
        FROM libros_generos 
        INNER JOIN generos ON libros_generos.id_genero = generos.id_genero 
        WHERE libros_generos.id_libro = '$id'");
        $generos = '';
        foreach ($row_genero as $row_genero) {
            if ($generos === '') {
                $generos = $row_genero['nombre_genero'];
            } else {
                $generos = $generos . ", " . $row_genero['nombre_genero'];
            }
        }
        return $generos;
    }

    public static function list_gender()
    {
        $g = Genero::all();
        return $g;
    }
    public static function list_gender_on_book($id_libro)
    {
        $genero_nombres = [];
        $list = LibrosGenero::find('all', array(
            'joins' => array('generos'),
            'select' => 'libros_generos.*, generos.*',
            'conditions' => 'id_libro = "' . $id_libro . '"'
        ));
        foreach ($list as $genero) {
            $genero_nombres[] = $genero->nombre_genero;
        }
        return $genero_nombres;
    }

    public static function insert_book($nombre, $descripcion, $fecha_publicacion, $stock, $autor, $generos)
    {
        $array_respuesta = array();
        // Verificar si el autor ya existe en la tabla
        $existeAutor = Autor::find('all', array('conditions' => array('nombre_autor = ?', $autor)));
        if (empty($existeAutor)) {
            // Insertar el autor solo si no existe
            $autor = Autor::create(['nombre_autor' => $autor]);
        } else {
            $autor = $existeAutor[0];
        }
        $name = $_FILES['imagen']['name'];
        $tmp_name = $_FILES['imagen']['tmp_name'];
        $type = $_FILES['imagen']['type'];

        // Verificar si la imagen es valida
        $extensiones_permit = array('jpg', 'jpeg', 'png', 'gif');
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        if (in_array($extension, $extensiones_permit) && is_uploaded_file($tmp_name) && strpos($type, 'image/') === 0) {
            try {
                $num_filas_total = Libro::count() + 1;
                // Mover la imagen a la carpeta de destino
                $ruta_portada = '../Assets/portadas_libros/id_' . $num_filas_total . '_' . $nombre . '_' . $name;
                $ruta_portada = str_replace(' ', '', $ruta_portada); //quitar los espacios en blanco
                move_uploaded_file($tmp_name, $ruta_portada);
                $ruta_portada = 'portadas_libros/id_' . $num_filas_total . '_' . $nombre . '_' . $name;
                $ruta_portada = str_replace(' ', '', $ruta_portada); //quitar los espacios en blanco
                // Insertar la ruta de la imagen en la base de datos
                $libro_nuevo = Libro::create([
                    'nombre' => $nombre, 'descripcion' => $descripcion, 'fecha_publicacion' => $fecha_publicacion,
                    'id_autor' => $autor->id_autor, 'stock' => $stock, 'img_portada' => $ruta_portada
                ]);

                $id_libro = $libro_nuevo->id_libro;
                foreach ($generos as $id_genero) {
                    LibrosGenero::create([
                        'id_libro' => $id_libro, 'id_genero' => $id_genero
                    ]);
                }
                Anuncio::create([
                    'id_libro' => $id_libro, 'tipo_anuncio' => 'Nuevo libro',
                    'descripcion' => 'Un nuevo libro ha sido agregado a nuestra biblioteca, puede que sea de su agrado'
                ]);

                $array_respuesta[1] = true;
                $array_respuesta[2] = "Libro registrado con exito. ";
                return $array_respuesta;
            } catch (Exception $e) {
                $array_respuesta[1] = false;
                $array_respuesta[2] = "Hubo un error inesperado al registrar el libro. " + $e->getMessage();
                return $array_respuesta;
            }
        } else {
            $array_respuesta[1] = false;
            $array_respuesta[2] = "Error al subir la imagen. Asegúrate de que seleccionaste un archivo válido.";
            return $array_respuesta;
        }
    }

    public static function delete_book($id_libro)
    {
        $array_respuesta = array();

        try {
            $lib = Libro::find_by_pk($id_libro);
            $lib->estado_libro = "INACTIVO";
            $lib->save();

            Anuncio::create([
                'id_libro' => $id_libro, 'tipo_anuncio' => 'Libro eliminado',
                'descripcion' => 'El libro ' . $lib->nombre . ' ha sido removido de nuestra biblioteca'
            ]);
            $array_respuesta[1] = true;
            $array_respuesta[2] = "El libro $lib->nombre ha sido eliminado con exito";
            return $array_respuesta;
        } catch (Exception $e) {
            $array_respuesta[1] = false;
            $array_respuesta[2] = "El libro $lib->nombre no se ha pidido eliminar. error: " . $e->getMessage();
            return $array_respuesta;
        }
    }

    public static function edit_book($id_libro, $nombre, $descripcion, $stock, $autor, $generos)
    {
        $array_respuesta = array();

        try {
            $lib = Libro::find_by_pk($id_libro);
            // Verificar si el autor ya existe en la tabla
            $existeAutor = Autor::find('all', array('conditions' => array('nombre_autor = ?', $autor)));
            if (empty($existeAutor)) {
                // Insertar el autor solo si no existe
                $autor = Autor::create(['nombre_autor' => $autor]);
            } else {
                $autor = $existeAutor[0];
            }
            $name = $_FILES['imagen']['name'];
            $tmp_name = $_FILES['imagen']['tmp_name'];
            $type = $_FILES['imagen']['type'];
            // Verificar si la imagen es valida
            $extensiones_permit = array('jpg', 'jpeg', 'png', 'gif');
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            if (in_array($extension, $extensiones_permit) && is_uploaded_file($tmp_name) && strpos($type, 'image/') === 0) {
                $num_filas_total = Libro::count() + 1;
                // Mover la imagen a la carpeta de destino
                $ruta_portada = '../Assets/portadas_libros/id_' . $num_filas_total . '_' . $nombre . '_' . $name;
                $ruta_portada = str_replace(' ', '', $ruta_portada); //quitar los espacios en blanco
                move_uploaded_file($tmp_name, $ruta_portada);
                $ruta_portada = 'portadas_libros/id_' . $num_filas_total . '_' . $nombre . '_' . $name;
                $ruta_portada = str_replace(' ', '', $ruta_portada); //quitar los espacios en blanco
                // Insertar la ruta de la imagen en la base de datos
                $lib->img_portada = $ruta_portada;
            }

            $lib->nombre = $nombre;
            $lib->descripcion = $descripcion;
            $lib->stock = $stock;
            $lib->id_autor = $autor->id_autor;
            $lib->save();

            $id_libro = $lib->id_libro;

            foreach ($generos as $id_genero) {
                $existingRecord = LibrosGenero::find('all', array(
                    'select' => 'libros_generos.*',
                    'conditions' => 'id_libro = "' . $id_libro . '" AND id_genero =' . $id_genero . ';'
                ));

                if (!$existingRecord) {
                    $libroGenero = new LibrosGenero(['id_libro' => $id_libro, 'id_genero' => $id_genero]);
                    $libroGenero->save();
                }
            }

            $generos_actuales = LibrosGenero::find('all', array(
                'select' => 'libros_generos.id_genero',
                'conditions' => 'id_libro = "' . $id_libro . '";'
            ));


            $array_generos_act = array();
            foreach ($generos_actuales as $genero) {
                $array_generos_act[] = $genero->id_genero;
            }
            // Comparar la lista actual con la lista de la página de edición
            $generos_a_eliminar = array_diff($array_generos_act, $generos);

            // Eliminar los géneros encontrados
            if (!empty($generos_a_eliminar)) {
                foreach ($generos_a_eliminar as $generos_delete) {
                    $genero = LibrosGenero::find('all', array(
                        'select' => 'libros_generos.*',
                        'conditions' => 'id_libro = "' . $id_libro . '" AND id_genero =' . $generos_delete . ';'
                    ));
                    $genero[0]->delete();
                }
            }
            $array_respuesta[1] = true;
            $array_respuesta[2] = "Libro editado con exito. ";
        } catch (Exception $e) {
            $array_respuesta[1] = false;
            $array_respuesta[2] = "Hubo un error inesperado al registrar el libro. " + $e->getMessage();
        }
        return $array_respuesta;
    }

    public static function select_dates()
    {
        try {
            $fechas = array();

            $temp = Usuario::find_by_sql("SELECT DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i') AS fecha;");
            $fechas[0] = $temp[0]->fecha;

            $temp = Usuario::find_by_sql("SELECT DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 3 DAY), '%Y-%m-%d %H:%i') AS fecha_3;");
            $fechas[1] = $temp[0]->fecha_3;

            return $fechas;
        } catch (Exception $e) {
            return null;
        }
    }

    public static function select_solic_prest_libro($id_libro)
    {
        $id_libro = Libro::find_by_pk($id_libro);
        if ($id_libro) {
            $id_libro = serialize($id_libro);
            $_SESSION["prestamo.libro"] = $id_libro;
            return true;
        } else {
            return false;
        }
    }

    public static function select_solic_prest_usuario($id_usuario)
    {
        $id_usuario = Usuario::find_by_pk($id_usuario);
        if ($id_usuario) {
            $id_usuario = serialize($id_usuario);
            $_SESSION["prestamo.usuario"] = $id_usuario;
            return true;
        } else {
            return false;
        }
    }

    public static function confirmar_prestamo()
    {
        try {
            $user = unserialize($_SESSION['prestamo.usuario']);
            $book = unserialize($_SESSION['prestamo.libro']);
            $array_respuesta = array();
            if ($user) {
                if ($user->prestamos_activos < 5) {
                    if ($user->puntaje > 0) {
                        Prestamo::create([
                            'id_libro' => $book->id_libro, 'cc_usuario' => $user->cedula
                        ]);
                        $user->prestamos_activos++;
                        $user->save();
                        $array_respuesta[0] = true;
                        $array_respuesta[1] = "Presamo registrado con exito";
                    } else {
                        $array_respuesta[0] = false;
                        $array_respuesta[1] = "El usuario ha sido penalizado por mal comportamiento, por tal motivo no se puede realizar el prestamo";
                    }
                } else {
                    $array_respuesta[0] = false;
                    $array_respuesta[1] = "El usuario ha alcanzado los prestamos maximos";
                }
            } else {
                $array_respuesta[0] = false;
                $array_respuesta[1] = "El usuario no existe en la base de datos";
            }
            return $array_respuesta;
        } catch (Exception $e) {
            $array_respuesta[0] = false;
            $array_respuesta[1] = "Hubo un error inesperado: " . $e->getMessage();
            return $array_respuesta;
        }
    }

    public static function list_prest($id_libro)
    {
        $array_respuesta = array();
        try {
            $list = Prestamo::query("SELECT *,usuarios.nombre AS nombre_usuario, usuarios.cedula , libros.nombre AS nombre_libro, autores.nombre_autor FROM prestamos 
            INNER JOIN libros ON prestamos.id_libro = libros.id_libro
            INNER JOIN autores ON libros.id_autor = autores.id_autor
            INNER JOIN usuarios ON prestamos.cc_usuario = usuarios.cedula
            WHERE libros.id_libro = $id_libro");
            $data = $list->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($list) || $list == null) {
                $array_respuesta[0] = true;
                $array_respuesta[1] = $data;
                return $array_respuesta;
            } else {
                $array_respuesta[0] = false;
                $array_respuesta[1] = "no sirve";
                return $array_respuesta;
            }
        } catch (Exception $e) {
            $array_respuesta[0] = false;
            $array_respuesta[1] = "Hubo un error inesperado: " . $e->getMessage();
            return $array_respuesta;
        }
    }

    public static function confirm_entrega($id_prestamo)
    {
        $array_respuesta = array();
        $prestamo = Prestamo::find_by_pk($id_prestamo);
        if ($prestamo) {
            $fecha_entrega = strtotime(date("d-m-Y H:i:00", time()));
            $fecha_max_devolucion = strtotime($prestamo->fecha_max_devolucion);
            if($fecha_entrega > $fecha_max_devolucion){
                $u = Usuario::find_by_pk($prestamo->cc_usuario);
                $u->puntaje = $u->puntaje-1;
                $u->save();
                $array_respuesta[2] = "El usuario excedio la fecha maxima de entrega y por ende sera penalziado"; 
            }
            $prestamo->estado_prestamo = "ENTREGADO";
            $prestamo->fecha_entrega = $fecha_entrega;
            $prestamo->save();
            $lista = servicio_admin::list_prest($prestamo->id_libro);
            $_SESSION['lista.prestamos'] = serialize($lista[1]);
            $array_respuesta[0] = true;
            $array_respuesta[1] = "El libro fue entregado con exito";
        }else{
            $array_respuesta[0] = false;
            $array_respuesta[1] = "El prestamo enviado no se encuentra registrado";
        }
        return $array_respuesta;
    }
}
