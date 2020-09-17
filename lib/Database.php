<?php
class Database{
    /* Propiedades */

    public $db;
    protected $resultado;
    protected $prep;
    protected $consulta;

    /* Método Constructor */
    
    public function __construct($dbhost, $dbuser, $dbpass, $dbname){
        $this->db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    
        if($this->db->connect_errno){
            trigger_error("No se puedo establecer conexión con MySQL. Tipo de error -> ( {$this->db->connect_error} )", E_USER_ERROR);
        }else{
            //echo "Conexion exitosa <br>";
        }

        $this->db->set_charset("utf8");
    }

    /* Métodos */

    public function getClientes(){
        $this->resultado = $this->db->query('SELECT * FROM clientes');
        return $this->resultado->fetch_all();
    }

    public function preparar($consulta){
        $this->consulta = $consulta;
        $this->prep = $this->db->prepare($this->consulta);

        if(!$this->prep){
            trigger_error("Error en la preparación de la consulta", E_USER_ERROR);
        } else {
            return true;
        }
    }

    public function ejecutar(){
        $this->prep->execute();        
    }

    public function prep(){
        return $this->prep;
    }

    public function resultado(){
        return $this->prep->fetch();
    }

    public function cambiarDatabase($namedb){
        $this->db->select_db($namedb);
    }

    public function validarDatos($columna, $tabla, $condicion){
        $this->resultado = $this->db->query("SELECT $columna FROM $tabla WHERE $columna = '$condicion'");
        $chequear = $this->resultado->num_rows;
        return $chequear;
    }

    public function cerrar(){
        $this->prep->close();
        $this->db->close();
    } 
}
