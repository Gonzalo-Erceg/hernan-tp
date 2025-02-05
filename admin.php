<?php 
    require_once "clases.php";



    



?>

 
<head>
    <link rel="stylesheet" href="./style.css">
</head>

<h2>Alta empleado</h2>

<form method="POST">
    <input name="nombre" placeholder="nombre">
    <input name="apellido" placeholder="apellido">
    <input name="usuario" placeholder="usuarios">
    <input name="contraseña" type="password" placeholder="contraseña">
    <button name="alta_empleado">Dar de alta</button>
</form>

<h3>
<?php 
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        if(isset($_POST["alta_empleado"])){
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $usuario = $_POST["usuario"];
            $contraseña = $_POST["contraseña"];


            $empleado = new Empleado($nombre, $apellido);
            $empleado->setClave($contraseña);
            $empleado->setUsuario($usuario);
            $id = $empleado->alta();
           
            if(isset($id)){
                echo "El numero del empleado cargado es {$id}";
            }
        }

    }

?>

</h3>





<table>
    <thead>
        <tr>
            <th>Nreo de Empleado</th>
            <th>Nombre </th>
            <th>Apellido</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $empleado = new Empleado("","");
            $resultado = $empleado->listar();
        ?>

        <?php if($resultado){?>
            <?php foreach($resultado as $fila): ?>
            <tr >
                <td><?= $fila["nroEmpleado"] ?> </td>
                <td><?= $fila["nombre"] ?> </td>
                <td><?= $fila["apellido"] ?> </td>

            </tr>
        <?php endforeach?>

        <?php } ?>


    </tbody>

</table>




<h3>Cargar Producto</h3>


<form method="POST">
    <input name="descripcion">
    <input type="number" name="precio" >
    <button name="alta_producto">Alta producto</button>
</form>


<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["alta_producto"])){
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];

            $producto = new Producto();
            $producto->SetDescripcion($descripcion);
            $producto->SetPrecio($precio);


            $id = $producto->alta();

            echo "El id del producto es: {$id}";
        }
    }


?>




<h3>Buscar producto</h3>



<form method="POST">
    <input name="descripcion" placeholder="Buscar por descripcion">
    <button name="buscar_descipcion">buscar</button>
</form>
<form method="POST">
    <input name="id" placeholder="Buscar por id" type="number">
    <button name="buscar_id">buscar</button>

</form>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["buscar_descipcion"])){
            $descripcion = $_POST["descripcion"];

            $producto = new Producto();
            $resultado = $producto->buscar("descripcion",$descripcion);
            if($resultado){
                foreach($resultado as $elemento){ ?>
                    <div>
                        <h2>Codigo: <?= $elemento["codigo"]?></h2>
                        <h3>Descripcion: <?= $elemento["descripcion"]?></h3>
                        <h4>Precio: <?= $elemento["precio"]?></h4>
                        
                    </div>
                   
                   
                   <?php 
                };
            }else{
                echo "no hay resultados";
            }
            
        }
        if(isset($_POST["buscar_id"])){
            $descripcion = $_POST["id"];

            $producto = new Producto();
            $resultado = $producto->buscar("codigo",$descripcion);
            if($resultado){
                foreach($resultado as $elemento){
                    ?>
                    <div>
                        <h2>Codigo: <?= $elemento["codigo"]?></h2>
                        <h3>Descripcion: <?= $elemento["descripcion"]?></h3>
                        <h4>Precio: <?= $elemento["precio"]?></h4>
                        
                    </div>
                   
                   
                   <?php
                };
            }else{
                echo "no hay resultados";
            }
            
        }
    }

?>

