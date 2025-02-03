<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$db = 'crud_completo_php';

$conn = new mysqli($hostname,$username,$password,$db);

if(!$conn){
    echo 'Erro ao conectar!!!';
}
else{
    // echo 'Conectado com sucesso!!!';
}

?>