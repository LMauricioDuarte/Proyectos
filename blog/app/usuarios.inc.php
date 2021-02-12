<?php

class Usuarios{
 
    private $id_usuario;
    private $nombre;
    private $email;
    private $c_password;
    private $fecha_registro;
    private $activo;
    
    /*estamos definiendo una accion algo que se va ejecuta*/
    public function __construct($id_usuario,$nombre,$email,$c_password,$fecha_registro,$activo){
        $this -> id_usuario = $id_usuario;
        $this -> nombre = $nombre;
        $this -> email= $email;
        $this -> c_password= $c_password;
        $this -> fecha_registro= $fecha_registro;
        $this -> activo= $activo;
    }
    
    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getC_password() {
        return $this->c_password;
    }

    public function getFecha_registro() {
        return $this->fecha_registro;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setC_password($c_password) {
        $this->c_password = $c_password;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }
    
}
