<?php 

//db connection pdo
function db(){
    $db = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8', 'root', '');
    return $db;
}

?>