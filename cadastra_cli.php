<?php
include './DB/connect.php';

var_dump($_POST);
// $_POST é uma variável GLOBAL do PHP --- APACHE --- request HTTP

if(isset($_POST['cadastrar'])){

    // print_r($_POST);

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $senha = $_POST['pass'];
    $senha2 = $_POST['conf_pass'];

    $sql = "INSERT INTO cliente (nome,cpf,fone,email) VALUES ('$nome','$cpf','$fone','$email')";

    $result = mysqli_query($conn,$sql);

    if($result){
        echo "Cadastrado com sucesso!!";
    }else{
        die(mysqli_error($coon));
    }
}

?>