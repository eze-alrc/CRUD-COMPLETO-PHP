<?php
include '../includes/db.php';

// Verifica se o ID do espaço foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do espaço no banco de dados
    $stmt = $conn->prepare("SELECT * FROM espacos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $espaco = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$espaco) {
        echo "Espaço não encontrado.";
        exit();
    }
} else {
    echo "ID do espaço não fornecido.";
    exit();
}

// Processa o formulário de edição
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $capacidade = $_POST['capacidade'];
    $descricao = $_POST['descricao'];

    // Atualiza os dados do espaço no banco de dados
    $stmt = $conn->prepare("UPDATE espacos SET nome = :nome, tipo = :tipo, capacidade = :capacidade, descricao = :descricao WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':capacidade', $capacidade);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->execute();

    // Redireciona de volta para a lista de espaços
    header("Location: espacos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Espaço</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Editar Espaço</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $espaco['id']; ?>">
        Nome: <input type="text" name="nome" value="<?php echo $espaco['nome']; ?>" required><br>
        Tipo: <input type="text" name="tipo" value="<?php echo $espaco['tipo']; ?>" required><br>
        Capacidade: <input type="number" name="capacidade" value="<?php echo $espaco['capacidade']; ?>" required><br>
        Descrição: <textarea name="descricao"><?php echo $espaco['descricao']; ?></textarea><br>
        <input type="submit" name="editar" value="Salvar Alterações">
    </form>
    <br>
    <a href="espacos.php">Voltar para a lista de espaços</a>
</body>
</html>