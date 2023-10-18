<?php
require_once './app/views/autores.view.php';
require_once './app/models/autores.model.php';

class AutoresController {

    private $view;
    private $model;

    function __construct() {
        AuthHelper::verify();

        $this->model = new AutoresModel();
        $this->view = new AutoresView();
    }

    public function showAutores() {
        $autores = $this->model->getAutores();
        $this->view->showAutores($autores);
    }

    public function addAutores() {
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $edad = isset($_POST['edad']) ? $_POST['edad'] : null;
        $nacionalidad = isset($_POST['nacionalidad']) ? $_POST['nacionalidad'] : null;

        if (empty($nombre) || empty($edad) || empty($nacionalidad)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }
        $id = $this->model->insertAutores($nombre, $edad, $nacionalidad);
        if ($id) {
            header('Location: ' . BASE_URL . 'listar');
        } else {
            $this->view->showError("Error al insertar el autor");
        }
    }

    function removeAutor($id_autor) {
        $this->model->deleteAutores($id_autor);
        header('Location: ' . BASE_URL);
    }

    public function updateAutor($nombre, $edad, $nacionalidad, $id_autor) {
        $this->model->updateAutores($nombre, $edad, $nacionalidad, $id_autor);
        header('Location: ' . BASE_URL . 'listar');
    }

    function editAutor($id_autor) {
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $nacionalidad = $_POST['nacionalidad'];

        $this->model->updateAutores($nombre, $edad, $nacionalidad, $id_autor);
        header('Location: ' . BASE_URL . 'listar');
    }
}