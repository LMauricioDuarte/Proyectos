<?php

class Comentario{
  
    private $id;
    private $autor_id;
    private $entrada_id;
    private $titulo;
    private $texto;
    private $fecha;
 
    function __construct($id, $autor_id, $entrada_id, $titulo, $texto, $fecha) {
        $this->id = $id;
        $this->autor_id = $autor_id;
        $this->entrada_id = $entrada_id;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->fecha = $fecha;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getAutor_id() {
        return $this->autor_id;
    }

    public function getEntrada_id() {
        return $this->entrada_id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setAutor_id($autor_id) {
        $this->autor_id = $autor_id;
    }

    public function setEntrada_id($entrada_id) {
        $this->entrada_id = $entrada_id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }



    
}
?>