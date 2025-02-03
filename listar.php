<?php
    include './DB/connect.php';

    $sql = 'SELECT * FROM cliente';
    $result = mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD COMPLETO PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <h3> Bem vindo </h3>
    <header>
        <ul>
            <li> <a href="index.php"> Cadastrar </a> </li>
            <li> <a href="listar.php"> Listar </a> </li>
        </ul>
    </header>
    <h1 class="py-5 mx-5">Clientes Cadastrados</h1>
    <div class="container">
        <table class="table table-striped">
            <tr>
                <td>Id</td>
                <td>Nome</td>
                <td>CPF</td>
                <td>Fone</td>
                <td>Email</td>
                <td>Editar</td>
                <td>Excluir</td>
            </tr>
            <?php
                if($result){
                    while($linha = mysqli_fetch_assoc($result)){

                        $id = $linha['id'];
                        $nome = $linha['nome'];
                        $cpf = $linha['cpf'];
                        $fone = $linha['fone'];
                        $email = $linha['email'];

                        echo '
                            <tr>
                                <td> '.$id.' </td>
                                <td> '.$nome.' </td>
                                <td> '.$fone.' </td>
                                <td> '.$cpf.' </td>
                                <td> '.$email.' </td>
                                <td> <a href="editar_cli.php?id='.$id.'"> Editar </a> </td>
                                <td> <a href="excluir_cliente.php?id='.$id.'"> Excluir </a> </td>
                            </tr>
                            ';
                    }
                }
                
            ?>
        </table>
    </div>
</body>
</html>