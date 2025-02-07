<?php
include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Espaços</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Gerenciar Espaços</h1>
    <form method="post">
        Nome: <input type="text" name="nome" required><br>
        Tipo: <input type="text" name="tipo" required><br>
        Capacidade: <input type="number" name="capacidade" required><br>
        Descrição: <textarea name="descricao"></textarea><br>
        <input type="submit" name="cadastrar" class="button" value="Cadastrar Espaço">
    </form>

    <?php
    if (isset($_POST['cadastrar'])) {
        $nome = $_POST['nome'];
        $tipo = $_POST['tipo'];
        $capacidade = $_POST['capacidade'];
        $descricao = $_POST['descricao'];

        $stmt = $conn->prepare("INSERT INTO espacos (nome, tipo, capacidade, descricao) VALUES (:nome, :tipo, :capacidade, :descricao)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':capacidade', $capacidade);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->execute();
    }

    $espacos = $conn->query("SELECT * FROM espacos");
    echo "<h2>Espaços Cadastrados</h2>";
    echo "<ul>";
    foreach ($espacos as $espaco) {
        echo "<li>{$espaco['nome']} - {$espaco['tipo']} (Capacidade: {$espaco['capacidade']}) <a href='editar_espaco.php?id={$espaco['id']}' class='button'>Editar</a> <a href='excluir_espaco.php?id={$espaco['id']}' class='button delete'>Excluir</a></li>";
    }
    echo "</ul>";
    ?>
</body>
</html>