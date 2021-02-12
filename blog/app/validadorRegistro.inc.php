<?php 
include_once 'repositorioUsuario.inc.php';

class validadorRegistro {
    
    private $aviso_inicio;
    private $aviso_cierre;
    
    private $nombre;
    private $email;
    private $clave;
    
    private $error_nombre;
    private $error_email;
    private $error_clave1;
    private $error_clave2;
    //agregamos la conexion ya que tenemos que trabajar con la base de datos
    public function __construct($nombre,$email,$clave1,$clave2,$conexion){
        $this -> aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this -> aviso_cierre = "</div>";
        
        $this -> nombre ="";
        $this -> email  ="";
        $this -> clave  ="";
        
        $this -> error_nombre = $this -> validar_nombre($conexion,$nombre);
        $this -> error_email = $this -> validar_email($conexion,$email);
        $this -> error_clave1 = $this -> validar_clave1($clave1);
        $this -> error_clave2 = $this -> validar_clave2($clave1,$clave2);
        
        if ($this -> error_clave1 === "" && $this -> error_clave2 === ""){
            $this -> clave = $clave1;
        }
    }
    
    private function variable_iniciada($variable){
        if(isset($variable) && !empty($variable)){
            return true;
        } else{
            return false;
        }   
    }
    
    private function validar_nombre($conexion,$nombre){
        if (!$this -> variable_iniciada($nombre)){
            return "Debes escribir un nombre de usuario";
        } else{
            $this -> nombre = $nombre;
        }
        /*vamos a usar strlen que valida la longitud de los datos ingresados*/
        if(strlen($nombre) <  6){
            return "El nombre debe ser mas largo que 6 caracteres.";
        }
        if(strlen($nombre) > 24){
            return "El nombre no puede ocupar mas de 24 caracteres";
        }
        if(RepositorioUsuarios::nombre_existe($conexion,$nombre)){ //USAMOS LOS DOS PUNTOS(::) para llamar a un metodo estatico
            return "Este nombre de usuario ya está en uso, por favor prueba otro nombre.";
        }
        
        return "";
    }
    
    private function validar_email($conexion,$email){
        if (!$this -> variable_iniciada($email)){
            return "Debes proporcionar un email";
        } else{
            $this -> email = $email;
        }
        if(RepositorioUsuarios::email_existe($conexion,$email)){
            return "Este email ya está en uso, por favor prueba con otro email o <a href='#'>Intente recuperar su contraseña</a>";
        }
        
        return "";
    }
    private function validar_clave1($clave1){
        if (!$this -> variable_iniciada($clave1)){
            return "Debes escribir una contraseña";
        }         
        
        return "";    
    }
    private function validar_clave2($clave1,$clave2){
        if(!$this -> variable_iniciada($clave1)){
            return "Primero debes rellenar la contraseña";
        }
        if (!$this -> variable_iniciada($clave2)){
            return "Debes repetir tu contraseña";
        }         
        if ($clave1 !== $clave2){
            return "Ambas contraseñas deben coincidir";
        }
        
        return "";    
    }

    public function get_nombre(){
        return $this -> nombre;
    }
    
    public function  get_email(){
        return $this -> email;
    }
    
    public function  get_clave(){
        return $this -> clave;
    }
    
    public function get_error_nombre(){
        return $this -> error_nombre;
    }
    
    public function get_error_email(){
        return $this -> error_email;
    }
    
    public function get_error_clave1(){
        return $this -> error_clave1;
    }
   
    public function get_error_clave2(){
        return $this -> error_clave2;
    }
    
    public function mostrar_nombre(){
        if ($this -> nombre !== ""){
            echo 'value="'. $this -> nombre . '"';
        }
    }
    
    public function mostrar_error_nombre(){
        if ($this -> error_nombre !== ""){
            echo $this -> aviso_inicio . $this -> error_nombre . $this -> aviso_cierre;
        }
    }
    
    public function mostrar_email(){
        if ($this -> email !== ""){
            echo 'value="'. $this -> email . '"';
        }
    }
    
    public function mostrar_error_email(){
        if ($this -> error_email !== ""){
            echo $this -> aviso_inicio . $this -> error_email . $this -> aviso_cierre;
        }
    }
    
    public function mostrar_error_clave1(){
        if ($this -> error_clave1 !== ""){
            echo $this -> aviso_inicio . $this -> error_clave1 . $this -> aviso_cierre;
        }
    }
    
    public function mostrar_error_clave2(){
        if ($this -> error_clave2 !== ""){
            echo $this -> aviso_inicio . $this -> error_clave2 . $this -> aviso_cierre;
        }
    }
    
    public function registro_valido(){
        if ($this -> error_nombre === "" && $this -> error_email === "" && $this -> error_clave1 === ""
                && $this -> error_clave2 === ""){
            return true;
        }else{
            return false;
        }
    }
}
?>
