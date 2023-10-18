<?php

class LibrosView {
    public function showLibros($Libros) {
        $count = count($Libros);
        require 'templates/librosTab.phtml';

        require 'templates/formLibros.phtml'; 
 
        require 'templates/footer.phtml';
    }

    public function showDetailedLibro($Libro) {
        require 'templates/header.phtml';
        require 'templates/detalleLibro.phtml';

        require 'templates/footer.phtml';
    }

    public function showLibroXid($Libros) {
        $count = count($Libros);
        require 'templates/header.phtml';
        require 'templates/formLibros.phtml';
        require 'templates/libros.phtml';

        require 'templates/footer.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}