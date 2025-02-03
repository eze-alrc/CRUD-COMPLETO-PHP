<?php
    include './DB/connect.php';
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
    <h1> Cadastro de Cliente</h1>
    <form method="POST" action="cadastra_cli.php">
        <input type="text" name="nome" id="nome" placeholder="Digite seu nome">
        <br>
        <input type="text" name="cpf" id="cpf" placeholder="Digite seu cpf">
        <br>
        <input type="text" name="fone" id="fone" placeholder="Digite seu telefone">
        <br>
        <input type="text" name="email" id="email" placeholder="Digite seu email">
        <br>
        <input type="password" name="pass" id="pass" placeholder="Digite sua senha">
        <br>
        <input type="password" name="conf_pass" id="conf_pass" placeholder="Confirme sua senha">
        <br>
        <input class="btn btn-success" type="submit" name="cadastrar" id="bot" value="cadastrar">
    </form>
</body>
</html>