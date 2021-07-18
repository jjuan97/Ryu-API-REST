<?php

include('bd.php');

$id=$_GET['id'];


$ruleEliminar = 'UPDATE reglas SET activacion = 0 WHERE id = ?';
$eliminando = $pdo->prepare($ruleEliminar);
$eliminando->execute(array($id));

header('location:appiRed.php');
?>