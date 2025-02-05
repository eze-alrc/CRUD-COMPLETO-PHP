<?php
include '../includes/db.php';

if(isset($_GET['id'])){

    $id_recebido = $_GET['id'];
    $sql = "DELETE FROM espacos WHERE id = $id_recebido";
    $result = mysqli_query($conn,$sql);

    if($result){
        echo '<script> alert("Excluido com sucesso!") </script>';
    }else{
        echo '<script> alert("Erro ao excluir!") </script>';
    }
}
?>