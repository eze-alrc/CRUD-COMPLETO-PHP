<?php
    // passo 1: conectar-se ao banco
    include './DB/connect.php';

    // passo 2: receber id via GET
    if(isset($_GET['id'])){
        $id_recebido = $_GET['id'];

        // passo 3: selecionar o cliente pelo id
        $sql = "SELECT * FROM cliente WHERE id=$id_recebido";
        // receber o resultado do banco
        $result = mysqli_query($conn,$sql);
        // converter para um array associativo chave->valor
        $resultado = mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['editar'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $fone = $_POST['fone'];

        $sql_update = "UPDATE cliente SET nome='$nome',email='$email',cpf='$cpf',fone='$fone' WHERE id = $id_recebido";

        $result_update = mysqli_query($conn,$sql_update);

        if($result_update){
            echo '<script> alert("Cliente atualizado com sucesso!!!") </script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD COMPLETO PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <header>
        <ul>
            <li> <a href="index.php"> Cadastrar </a> </li>
            <li> <a href="listar.php"> Listar </a> </li>
        </ul>
    </header>
    <h1>Editar Cliente</h1>
    <form method="POST">
        <input type="text" name="nome" id="nome" placeholder="Digite seu nome" value="<?php echo $resultado['nome'];?>">
        <br>
        <input type="text" name="cpf" id="cpf" placeholder="Digite seu cpf" value="<?php echo $resultado['cpf'];?>">
        <br>
        <input type="text" name="fone" id="fone" placeholder="Digite seu telefone" value="<?php echo $resultado['fone'];?>">
        <br>
        <input type="text" name="email" id="email" placeholder="Digite seu email" value="<?php echo $resultado['email'];?>">
        <br>
        <button type="reset" class="btn btn-danger"> Cancelar </button>
        <button type="submit" name="editar" class="btn btn-primary"> Editar </button>
    </form>
</body>
</html>