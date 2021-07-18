<?php
    include "connection.php";
		
	$json=array();
    $queryStr="SELECT * FROM reglas";
	$resultado=$connection -> query($queryStr);

	while($registro=$resultado->fetch_array()){
		$producto['hora_inicio']= $registro['horaInicio'];
		$producto['hora_fin']= $registro['horaFin'];
		$producto['mac_src']= $registro['hostOrigen'];
		$producto['mac_dst']= $registro['hostDestino'];		
		$producto['permanente']= $registro['permanente'];
		$producto['temporal']= $registro['temporal'];
		$producto['activacion']= $registro['activacion'];
		$json['reglas'][]=$producto;
	}
	$resultado -> close();
	echo json_encode($json);    

?>