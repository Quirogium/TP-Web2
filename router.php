<?php
require_once './app/controllers/autores.controller.php';
require_once './app/controllers/libros.controller.php';
require_once './app/controllers/login.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'login';
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {

    case 'listar':
        $controller = new AutoresController();
        $libroController = new LibrosController();
        $controller->showAutores();
        $libroController->showLibros();
        break;

    case 'agregarAutor':
        $controller = new AutoresController();
        $controller->addAutores();
        break;

    case 'agregarLibro':
        $libroController = new LibrosController();
        $libroController->addLibros();
        break;

    case 'eliminarAutor':
        $controller = new AutoresController();
        $controller->removeAutor($params[1]);
        break;

    case 'eliminarLibro':
        $libroController = new LibrosController();
        $libroController->removeLibros($params[1]);
        break;

    case 'editarAutor':
        $controller = new AutoresController();
        $controller->editAutor($params[1]);
        break;

    case 'editarLibro':
        $libroController = new LibrosController();
        $libroController->editLibros($params[1]);
        break;

    case 'mostrarAutor':
        if (isset($params[1])){
        $libroController = new LibrosController();
        $libroController->showLibroXAutor($params[1]);
        }
        break;

    case 'verDetalleLibro':
        $libroController = new LibrosController;
        $libroController->showDetalleLibro($params[1]);
        break;
    case 'login':
        $controller = new LoginController();
        $controller->showLogin(); 
        break;         
    case 'auth':
        $controller = new LoginController;
        $controller->auth();
        break;
    case 'logout':
        $controller = new LoginController();
        $controller->logout();
        break;

    default: 
        echo "404 Page Not Found";
        break;
}