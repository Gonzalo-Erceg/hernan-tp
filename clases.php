<?php 

    trait Connection{
        private $host = "localhost";
        private $userName = "root";
        private $password = "";
        private $nameDB = "HernanZapataIntegrador";

        public function Conectar(){
            try{
                $conn = new mysqli($this->host,$this->userName, $this->password, $this->nameDB);
                return $conn;

            }catch(Exception $e){
                echo "Erro al cargar la base de datos";
            }

        }

       
    }

    interface iABM{
        
        public function alta();
        public function listar();
        public function buscar($opcion,$busqueda);
    }



    class Producto implements iABM{
        private $codigo;
        private $descripcion;
        private $precio;
        use Connection;

     
        public function SetDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
        public function SetPrecio($precio){
            $this->precio = $precio;
        }


        public function alta(){
            $conn = $this->Conectar();

            $query ="INSERT INTO productos (descripcion,precio) VALUES ('{$this->descripcion}',{$this->precio})";

            $result = $conn->query($query);

            
            if($result){
                return $conn->insert_id;
            }
        }
        public function listar(){
            $conn = $this->Conectar();

            $query = "SELECT * FROM productos";

            $result = $conn->query($query);

            $array = [];

            if($result->num_rows>0){
                while($producto = $result->fetch_assoc()){
                    array_push($array,$producto);
                }
                

            };
            return $array;

        }
        public function buscar($opcion, $busqueda){
            $conn = $this->Conectar();

            $query = "SELECT * FROM productos WHERE {$opcion} LIKE '{$busqueda}'";

            $result = $conn->query($query);
            
            if($result->num_rows>0){
                $array = [];
                while($elemento = $result->fetch_assoc()){
                    array_push($array,$elemento);
                }
                return $array;
            }else{
                return false;
            }


        }
    }


    abstract class Usuario{
        protected $nombre;
        protected $apellido;
        protected $usuario;
        protected $clave;
        abstract public function iniciarSesion();
        abstract public function cerrarSesion();
        
    }

    
    class Empleado extends Usuario implements iABM{
        use Connection;
        private $nroEmpleado;

        public function __construct($nombre,$apellido)
        {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
        }
        public function mostrarDatos(){
            echo "<h1>Datos del usuario</h1>";
            echo "nombre: " . $this->nombre . "<br>";
            echo "apellido: " . $this->apellido . "<br>";
            echo "usuario: " . $this->usuario . "<br>";
            echo "contra: " . $this->clave . "<br>";
        }
        public function iniciarSesion()
        {
            $conn = $this->Conectar();
            $query = "SELECT * FROM empleados WHERE usuario = '{$this->usuario}'";

            $result= $conn->query($query);
            if($result->num_rows>0){
                $user = $result->fetch_assoc();
                
                if($user["contra"] == $this->clave){
                    $this->usuario = $user["usuario"];
                    $this->clave = $user["contra"];
                    $this->nombre = $user["nombre"];
                    $this->apellido = $user["apellido"];
    
                    $_SESSION["usuario"] =  $user["usuario"];
                    $_SESSION["clave"] =  $user["contra"];
                    $_SESSION["nombre"] =  $user["nombre"];
                    $_SESSION["apellido"] =  $user["apellido"];
                    $this->mostrarDatos();
                }else{
                    return "usuario o contraseña incorrectos";
                }



               
            }



        }
        public function cerrarSesion()
        {
            session_destroy();

            header("Location: index.php");
        }
        
        public function setClave($clave){
            $this->clave = $clave;

        }
        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }
        public function alta(){
            $conn = $this->Conectar();

            $query = "INSERT INTO empleados (nombre,apellido,usuario,contra) VALUES ('{$this->nombre}','{$this->apellido}','{$this->usuario}','{$this->clave}')";

            try{
                $conn->query($query);

                return $conn->insert_id;
            }catch(Exception $err){
                if($err->getCode() == 1062){
                    echo "El nombre de usuario ya esta registrado";
                }
                
            }
           
        }
        public function listar(){
            $conn = $this->Conectar();

            $query = "SELECT * FROM empleados";

            $resultado = $conn->query($query);
            $array = [];

            if($resultado->num_rows>0){
                while($empleado = $resultado->fetch_assoc()){
                    array_push($array,$empleado);
                }
                return $array;
            }else{
                return false;
            }

        }
        public function buscar($opcion,$busqueda){
            $conn = $this->Conectar();

            $sql = "SELECT * FROM empleados WHERE {$opcion} = '{$busqueda}'";

            $resultado = $conn->query($sql);

            $array = [];
            if($resultado->num_rows>0){
                while($elemento = $resultado->fetch_assoc()){
                    array_push($array,$elemento);
                };
            }else{
                return false;
            }
            

        }
        
    }

    

?>