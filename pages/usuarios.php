<?php
include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <h1>Gerenciar Usuários</h1>
    <form method="post">
        Nome: <input type="text" name="nome" required><br>
        E-mail: <input type="email" name="email" required><br>
        Telefone: <input type="text" name="telefone"><br>
        <input type="submit" name="cadastrar" value="Cadastrar Usuário">
    </form>

    <?php
    if (isset($_POST['cadastrar'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, telefone) VALUES (:nome, :email, :telefone)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->execute();
    }

    $usuarios = $conn->query("SELECT * FROM usuarios");
    echo "<h2>Usuários Cadastrados</h2>";
    echo "<ul>";
    foreach ($usuarios as $usuario) {
        echo "<li>{$usuario['nome']} - {$usuario['email']} <a href='editar_usuario.php?id={$usuario['id']}'>Editar</a> <a href='excluir_usuario.php?id={$usuario['id']}'>Excluir</a></li>";
    }
    echo "</ul>";
    ?>
</body>
</html>