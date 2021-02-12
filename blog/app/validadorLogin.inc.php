<?php

class ValidadorLogin{
    
    private $usuario;
    private $error;
    
    public function __construct($email, $clave, $conexion) {
        $this -> error = "";
        
        if(!$this -> variable_iniciada($email) || !$this -> variable_iniciada($clave)){
            $this -> usuario = null;
            $this -> error = "Debes introducir tu email y tu contraseña";
        }else{
            $this -> usuario = RepositorioUsuarios::obtener_usu_email($conexion, $email);
            
            if(is_null($this -> usuario) || !password_verify($clave, $this -> usuario -> getC_password())){
                $this -> error = "Datos incorrectos";
            }
        }
                
    }
    
    private function variable_iniciada($variable){
        if(isset($variable) && !empty($variable)){
            return true;
        } else{
            return false;
        }   
    }
    
    public function obtener_usuario(){
        return $this -> usuario;
    }
    
    public function obtener_error(){
        return $this -> error;
    }
    
    public function mostrar_error(){
        if ($this -> error !== ''){
            echo "<br><div class='alert alert-danger' role='alert'>";
            echo $this -> error;
            echo "</div>";
        }
    }
    
    
}