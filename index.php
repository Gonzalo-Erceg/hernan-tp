<?php 
    require_once "clases.php";
    session_start();
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["iniciar_sesion"])){
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $emplado = new Empleado($nombre,$apellido);


            $emplado->iniciarSesion();
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
    <input name="nombre" placeholder="nombre">
    <input name="apellido" placeholder="apellido">
    <button name="iniciar_sesion">INICIAR SESION</button>
    <button name="cerrar_sesion">CERRAR SESION</button>


</form>

<h1>BUSCAR</h1>
<form method="POST">
    <input name="nombre" placeholder="nombre">
    
    <button name="buscar">BUSCAR</button>
   


</form>



<?php if(isset($_SESSION["nombre"])){ ?>
<div style="width:100px;height: 100px;border-radius: 50% ;background:red"><?= $_SESSION["nombre"]?></div>
<?php }?>