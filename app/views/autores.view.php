<?php

class AutoresView {
    public function showAutores($autores) {
        require 'templates/header.phtml'; 
        require 'templates/autoresList.phtml'; 
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}