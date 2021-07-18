<?php
$link = 'mysql:host=localhost;dbname=enfasis3';
$usuario = 'root';
$pass = '';

try{

    $pdo = new PDO($link,$usuario,$pass,array(
        PDO::ATTR_PERSISTENT => true
    ));
    
    echo 'conectado';


}catch(PDOException $e){

    print "¡Error: ". $e->getMessage() . "<br/>";
    die();
}

?>