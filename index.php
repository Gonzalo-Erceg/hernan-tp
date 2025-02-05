<?php 
    require_once "clases.php";
    session_start();
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["iniciar_sesion"])){
            $usuario = $_POST["usuario"];
            $contra = $_POST["contra"];
            $emplado = new Empleado("","");
            $emplado->setClave($contra);
            $emplado->setUsuario($usuario);  


            $result = $emplado->iniciarSesion();

            
        }
        if(isset($_POST["cerrar_sesion"])){
            $emplado = new Empleado($_SESSION["nombre"],$_SESSION["apellido"]);

            $emplado->cerrarSesion();
        }
        if(isset($_POST["buscar"])){
            $nombre = $_POST["nombre"];

            $empleado = new Empleado($nombre,"");

            $ResultadoEmpleado = $empleado->buscar("nombre",$nombre);

            if($ResultadoEmpleado){
                echo $ResultadoEmpleado[0]["nombre"];
            }
        }
    };

?>




<form method="POST">
    <input name="usuario" placeholder="usuario">
    <input name="contra" placeholder="contra">
    <button name="iniciar_sesion">INICIAR SESION</button>
    <button name="cerrar_sesion">CERRAR SESION</button>


</form>

<h1>BUSCAR</h1>
<form method="POST">
    <input name="nombre" placeholder="nombre">
    
    <button name="buscar">BUSCAR</button>
   


</form>
<?= $_SESSION["usuario"] ?>


