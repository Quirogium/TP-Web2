<?php

class LibrosModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS);
    }

    public function getLibros() {
        $query = $this->db->prepare('SELECT * FROM `libros`');
        $query->execute();
        
        $Libros = $query->fetchAll(PDO::FETCH_OBJ);

        return $Libros;
    }

    public function getLibroId($Autor_id) {
        $query = $this->db->prepare("SELECT *, autores.Nombre AS AuthorName, libros.Titulo AS LibroTitulo FROM libros JOIN autores ON autores.id_autor = libros.id_autor WHERE libros.id_libros = ?");
        $query->execute([$Autor_id]);
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $result;
    }
    public function getDetalleLibro($Libro_id) {
        $query = $this->db->prepare('SELECT *, autores.Nombre AS AuthorName, libros.Titulo AS LibroTitulo FROM libros JOIN autores ON autores.id_autor = libros.id_autor WHERE libros.id_libros = ?');
        $query->execute([$Libro_id]);

        $Libro = $query->fetchAll(PDO::FETCH_OBJ);

        return $Libro;
    }

    public function getLibrosXId($id_autor) {
        $query = $this->db->prepare('SELECT *, autores.Nombre AS AuthorName, libros.Titulo AS LibroTitulo FROM libros JOIN autores ON autores.id_autor = libros.id_autor WHERE libros.id_autor = ?');
        $query->execute([$id_autor]);

        $Libros = $query->fetchAll(PDO::FETCH_OBJ);

        return $Libros;
    }

    public function insertLibro($Titulo, $Saga, $Genero, $id_autor, $Fecha_de_publicacion_original, $Fecha_de_publicacion_traduccion, $Editorial_original, $Editorial_traduccion) {
        $query = $this->db->prepare('INSERT INTO libros (Titulo, Saga, Genero, id_autor, Fecha_de_publicacion_original, Fecha_de_publicacion_traduccion, Editorial_original, Editorial_traduccion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $query->execute([$Titulo, $Saga, $Genero, $id_autor, $Fecha_de_publicacion_original, $Fecha_de_publicacion_traduccion, $Editorial_original, $Editorial_traduccion]);

        return $this->db->lastInsertId();
    }

    public function deleteLibro($Libro_id) {
        $query = $this->db->prepare('DELETE FROM libros WHERE id_libros = ?');
        $query->execute([$Libro_id]);
    }

    public function updateLibro($Libro_id, $Titulo, $Saga, $Genero, $id_autor, $Fecha_de_publicacion_original, $Fecha_de_publicacion_traduccion, $Editorial_original, $Editorial_traduccion) {
        $query = $this->db->prepare('UPDATE libros SET Titulo = ?, Saga = ?, Genero = ?, id_autor = ?, Fecha_de_publicacion_original = ?, Fecha_de_publicacion_traduccion = ?, Editorial_original = ?, Editorial_traduccion = ? WHERE id_libros = ?');
        $query->execute([$Titulo, $Saga, $Genero, $id_autor, $Fecha_de_publicacion_original, $Fecha_de_publicacion_traduccion, $Editorial_original, $Editorial_traduccion, $Libro_id]);
    }
}