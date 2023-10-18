<?php

class AuthHelper {

    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) { //Verifica si la sesion esta activa
            session_start();                          //Si no lo esta, la inicia
        }                                             //Si ya esta activa, no hace nada
    }

    public static function login($user) {   
        AuthHelper::init();                             //Verifica si la sesion esta activa
        $_SESSION['user_id'] = $user->user_id;          //Inicia la sesion con los datos del usuario requerido
        $_SESSION['user_name'] = $user->user_name;
    }

    public static function logout() {
        AuthHelper::init();
        session_destroy();
    }

    public static function verify() {
        AuthHelper::init();
        if (!isset($_SESSION['user_id'])) {                 //En caso de que no este seteado el user_id (no se inicio la sesion),
            header('Location: ' . BASE_URL . 'login');      //se envia al usuario a la pagina de login
            die();
        }
    }
}