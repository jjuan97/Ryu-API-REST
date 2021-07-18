<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $nameDB = "enfasis3";

    $connection = new mysqli($host, $user, $password, $nameDB);
    if ($connection->connect_errno){
        echo "Error al conectar con la BD";
    }
	$connection->set_charset("utf8");
?>