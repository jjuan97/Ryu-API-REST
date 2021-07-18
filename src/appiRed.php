<?php

    include_once 'bd.php';
    $leer = 'SELECT * FROM reglas WHERE activacion = 1';
    $respuesta = $pdo->prepare($leer);
    $respuesta->execute();
    $resultado = $respuesta->fetchAll();  

    if($_POST){

        $HoraInicio=$_POST['horaInicioE'];
        $HoraFin=$_POST['horaFinE'];
        $HostDestino = $_POST['hostDestinoE'];
        $HostOrigen=$_POST['hostOrigenE'];
        
        $EstadoRB = $_POST['Estado'];
        
        if($EstadoRB=="Temporal"){
            $Reglas = array($HoraInicio,$HoraFin,$HostOrigen,$HostDestino,false,true,1);
        }else{
            $Reglas = array($HoraInicio,$HoraFin,$HostOrigen,$HostDestino,true,false,1);
        }
           
        $insertar = 'INSERT INTO reglas (horaInicio,horaFin,hostOrigen,hostDestino,permanente,temporal,activacion) VALUES (?,?,?,?,?,?,?)';
        $agregar = $pdo->prepare($insertar);
        $agregar->execute($Reglas);
    
        $pdo = null;

        clearstatcache();
        header('location:appiRed.php');

    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./appiRed.css">
</head>

<body>
    <div id="nuevasReglas">
        <form id="Agregar" name="nuevasR" method="POST"> 
            <?php
            

    
            ?>
            <h4>Hora Inicio</h4>
            <input class="casillas" id="horaInicio" name="horaInicioE"  type="text">
            <h4>Hora Finalizacion</h4>
            <input class="casillas" id="horaFinalizacion" name="horaFinE" type="text">
            <h4>Host Origen</h4>
            <input class="casillas" id="hostOrigen" name="hostOrigenE" type="text">
            <h4>Host Destino</h4>
            <input class="casillas" id="hostDestino" name="hostDestinoE" type="text">
            <br>
            <br>
            <br>
            Permanente<input type="radio" name="Estado" value="Permanente">
            Temporal<input type="radio" name="Estado" value="Temporal">
            <br>
            <br>
            <br>
            <input type="submit" value="Agregar Regla">
            <br>
            

        </form>
    </div>
    <br>

    <div id="nueb">
        <table id="obj" border="1">
            
                <tr>
                    <th> Eliminar</th>
                    <th> # Regla </th>
                    <th> Host Origen </th>
                    <th> Host Destino </th>
                    <th> Hora Inicio </th>
                    <th> Hora Finalizacion </th>
                    <th> Permanente</th>
                    <th> Temporal</th>

                </tr>
                <?php

                    foreach($resultado as $rule):

                     

                ?>
                <tr>
                <td><a href="eliminar.php?id=<?php echo $rule['id']?>"> Eliminar </a></td>
                <td><?php echo $rule['id']?></td>
                <td><?php echo $rule['hostOrigen']?></td>
                <td><?php echo $rule['hostDestino']?></td>
                <td><?php echo $rule['horaInicio']?></td>
                <td><?php echo $rule['horaFin']?></td>
                <td><?php echo $rule['permanente']?></td>
                <td><?php echo $rule['temporal']?></td>

                </tr> 

                <?php
                        
                endforeach
                ?>            
        </table>
    </div>

    <script src="appiRed.js"></script>

</body>

</html>

