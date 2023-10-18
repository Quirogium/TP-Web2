<?php
require_once './app/views/libros.view.php';
require_once './app/models/libros.model.php';

class LibrosController {

    private $view;
    private $model;

    public function __construct() {
        $this->view = new LibrosView();
        $this->model = new LibrosModel();
    }

    public function showLibros() {
        $Libros = $this->model->getLibros();
        $this->view->showLibros($Libros);
    }

    public function showLibroXAutor($Autor_id) {
        $Libros = $this->model->getLibroId($Autor_id);
        $this->view->showLibroXid($Libros);
    }

    public function showDetalleLibro($Libro_id) {
        $Libros = $this->model->getDetalleLibro($Libro_id);
        $this->view->showDetailedLibro($Libros);
    }

    public function addLibros() {
        $Titulo = $_POST['Titulo'];
        $Saga = $_POST['Saga'];
        $Genero = $_POST['Genero'];
        $id_autor = $_POST['id_autor'];
        $Fecha_de_publicacion_original = $_POST['Fecha_de_publicacion_original'];
        $Fecha_de_publicacion_traduccion = $_POST['Fecha_de_publicacion_traduccion'];
        $Editorial_original = $_POST['Editorial_original'];
        $Editorial_traduccion = $_POST['Editorial_traduccion'];

        if (empty($Titulo) || empty($Saga) || empty($Genero) || empty($id_autor) || empty($Fecha_de_publicacion_original)) {
            $this->view->showError("Debe completar todos los campos necesarios");
            return;
        }

        $id_libro = $this->model->insertLibro($Titulo, $Saga, $Genero, $id_autor, $Fecha_de_publicacion_original, $Fecha_de_publicacion_traduccion, $Editorial_original, $Editorial_traduccion);

        if ($id_libro) {
            header('Location: ' . BASE_URL . 'listar');
        } else {
            $this->view->showError("Error al insertar el libro");
        }
    }

    function removeLibros($Libro_id) {
        $this->model->deleteLibro($Libro_id);
        header('Location: ' . BASE_URL . 'listar');
    }

    function editLibros($Libro_id) {
      
        $id_libro = $Libro_id;  
        $Titulo = $_POST['Titulo'];
        $Saga = $_POST['Saga'];
        $Genero = $_POST['Genero'];
        $id_autor = $_POST['id_autor'];
        $Fecha_de_publicacion_original = $_POST['Fecha_de_publicacion_original'];
        $Fecha_de_publicacion_traduccion = $_POST['Fecha_de_publicacion_traduccion'];
        $Editorial_original = $_POST['Editorial_original'];
        $Editorial_traduccion = $_POST['Editorial_traduccion'];
    
        
        $result = $this->model->updateLibro($id_libro, $Titulo, $Saga, $Genero, $id_autor, $Fecha_de_publicacion_original, $Fecha_de_publicacion_traduccion, $Editorial_original, $Editorial_traduccion);
    
        if ($result) {
            header('Location: ' . BASE_URL . 'listar');
        } else {
            $this->view->showError("Error al editar el libro");
        }
    }
}