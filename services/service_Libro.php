<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Libro/LibroCrud.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Autor/AutorCrud.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Genero/GeneroCrud.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Anuncio/AnuncioCrud.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/services/service_Autor.php";

class service_Libro
{

    public static function find_book($id)
    {
        return LibroCrud::find_book($id);
    }
    public static function list_books()
    {
        return LibroCrud::listAllBooks();
    }
    public static function listSearchBooks($opcion, $busqueda)
    {
        return LibroCrud::listSearchBooks($opcion, $busqueda);
    }

    public static function insert_book($nombre, $descripcion, $fecha_publicacion, $stock, $nombreAutor, $generos)
    {
        $array_respuesta = array();
        try {
            // Verificar si el autor ya existe en la tabla
            $autor = service_Autor::verify_exist_autor($nombreAutor);
            if (!($autor instanceof Autor)) {
                throw new Exception($autor);
            }
            $name = $_FILES['imagen']['name'];
            $tmp_name = $_FILES['imagen']['tmp_name'];
            $type = $_FILES['imagen']['type'];

            // Verificar si la imagen es valida
            $extensiones_permit = array('jpg', 'jpeg', 'png', 'gif');
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            if (in_array($extension, $extensiones_permit) && is_uploaded_file($tmp_name) && strpos($type, 'image/') === 0) {
                $num_filas_total = LibroCrud::countBook() + 1;
                // Mover la imagen a la carpeta de destino
                $ruta_portada = '../Assets/portadas_libros/id_' . $num_filas_total . '_' . $nombre . '_' . $name;
                $ruta_portada = str_replace(' ', '', $ruta_portada); //quitar los espacios en blanco
                move_uploaded_file($tmp_name, $ruta_portada);
                $ruta_portada = 'portadas_libros/id_' . $num_filas_total . '_' . $nombre . '_' . $name;
                $ruta_portada = str_replace(' ', '', $ruta_portada); //quitar los espacios en blanco
                // Insertar la ruta de la imagen en la base de datos
                $libro_nuevo = LibroCrud::createBook($nombre, $descripcion, $fecha_publicacion, $stock, $autor, $generos, $ruta_portada);
                if (!($libro_nuevo instanceof Libro)) {
                    throw new Exception($libro_nuevo);
                }

                $id_libro = $libro_nuevo->id_libro;
                foreach ($generos as $id_genero) {
                    $genero = service_Genero::createGenero($id_libro, $id_genero);
                    if (!($genero instanceof LibrosGenero)) {
                        throw new Exception($genero);
                    }
                }
                $anuncio = service_Anuncio::createAnunce($id_libro, $nombre, "add");
                if (!($anuncio instanceof Anuncio)) {
                    throw new Exception($anuncio);
                }
                $array_respuesta[1] = true;
                $array_respuesta[2] = "Libro registrado con exito. ";
                $_SESSION["libro.respuesta"] = serialize($array_respuesta);
            } else {
                throw new Exception("Error al subir la imagen. Asegúrate de que seleccionaste un archivo válido.");
            }
        } catch (Exception $e) {
            $array_respuesta[1] = false;
            $array_respuesta[2] = urldecode("Hubo un error inesperado al registrar el libro. " . $e->getMessage() . " en el archivo " . $e->getFile() . " en la línea " . $e->getLine());
            $_SESSION["libro.respuesta"] = serialize($array_respuesta);
        }
    }
    public static function delete_book($id_libro)
    {
        $array_respuesta = array();

        try {
            $lib = LibroCrud::deleteBook($id_libro);
            if (!($lib instanceof Libro)) {
                throw new Exception($lib);
            }
            $anunc = service_Anuncio::createAnunce($id_libro, $lib->nombre, "del");
            if (!($anunc instanceof Anuncio)) {
                throw new Exception($anunc);
            }
            $array_respuesta[1] = true;
            $array_respuesta[2] = "Libro eliminado con exito. ";
            $_SESSION["libro.respuesta"] = serialize($array_respuesta);
        } catch (Exception $e) {
            $array_respuesta[1] = false;
            $array_respuesta[2] = "El libro $lib->nombre no se ha podido eliminar. error: " . $e->getMessage();
            $_SESSION["libro.respuesta"] = serialize($array_respuesta);
        }
    }
    public static function edit_book($id_libro, $nombre, $descripcion, $stock, $nombreAutor, $generos)
    {
        $array_respuesta = array();
        try {
            // Verificar si el autor ya existe en la tabla
            $autor = service_Autor::verify_exist_autor($nombreAutor);
            if (!($autor instanceof Autor)) {
                throw new Exception($autor);
            }
            $name = $_FILES['imagen']['name'];
            $tmp_name = $_FILES['imagen']['tmp_name'];
            $type = $_FILES['imagen']['type'];

            // Verificar si la imagen es válida
            $extensiones_permit = array('jpg', 'jpeg', 'png', 'gif');
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            if (in_array($extension, $extensiones_permit) && is_uploaded_file($tmp_name) && strpos($type, 'image/') === 0) {
                $libr = self::find_book($id_libro);

                // Ruta y nombre del nuevo archivo
                $ruta_absoluta = $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/Assets/" . $libr->img_portada;

                // Mover el archivo subido a la nueva ubicación
                if (!move_uploaded_file($tmp_name, $ruta_absoluta)) {
                    throw new Exception("No se pudo mover el archivo a la nueva ubicación.");
                }
            }
            $libro_nuevo = LibroCrud::editBook($id_libro, $nombre, $descripcion, $stock, $autor->id_autor, $generos);
            if (!($libro_nuevo instanceof Libro)) {
                throw new Exception($libro_nuevo);
            }

            $id_libro = $libro_nuevo->id_libro;
            foreach ($generos as $id_genero) {
                $genero = service_Genero::createGenero($id_libro, $id_genero);
                if (!($genero instanceof LibrosGenero)) {
                    throw new Exception($genero);
                }
            }
            $anuncio = service_Anuncio::createAnunce($id_libro, $nombre, "update");
            if (!($anuncio instanceof Anuncio)) {
                throw new Exception($anuncio);
            }
            $array_respuesta[1] = true;
            $array_respuesta[2] = "Libro editado con exito. ";
            $_SESSION["libro.respuesta"] = serialize($array_respuesta);
        } catch (Exception $e) {
            $array_respuesta[1] = false;
            $array_respuesta[2] = urldecode("Hubo un error inesperado al edita el libro. " . $e->getMessage() . " en el archivo " . $e->getFile() . " en la línea " . $e->getLine());
            $_SESSION["libro.respuesta"] = serialize($array_respuesta);
        }
    }
}
