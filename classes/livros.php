<?php
class Livro {
    private $id;
    private $titulo;
    private $autor;
    private $anoPublicacao;
    private $editora;

    public function __construct($titulo, $autor, $anoPublicacao, $editora) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anoPublicacao = $anoPublicacao;
        $this->editora = $editora;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getAnoPublicacao() {
        return $this->anoPublicacao;
    }

    public function setAnoPublicacao($anoPublicacao) {
        $this->anoPublicacao = $anoPublicacao;
    }

    public function getEditora() {
        return $this->editora;
    }

    public function setEditora($editora) {
        $this->editora = $editora;
    }
}

?>