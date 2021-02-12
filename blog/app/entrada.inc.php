<?php

class Entrada{

    private $id;
    private $autor_id;
    private $url;
    private $titulo;
    private $texto;
    private $fecha;
    private $activa;
    
    public function __construct($id,$autor_id,$url,$titulo,$texto,$fecha,$activa){
        $this -> id = $id;
        $this -> autor_id = $autor_id;
        $this -> url = $url;
        $this -> titulo = $titulo;
        $this -> texto = $texto;
        $this -> fecha = $fecha;
        $this -> activa = $activa;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getAutor_id() {
        return $this->autor_id;
    }
    
    public function getUrl(){
        return $this->url;
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

    public function getActiva() {
        return $this->activa;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setAutor_id($autor_id) {
        $this->autor_id = $autor_id;
    }
    
    public function setUrl($url){
        $this->url = $url;
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

    public function setActiva($activa) {
        $this->activa = $activa;
    }
        
}

