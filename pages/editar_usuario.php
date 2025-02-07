<?php
include '../includes/db.php';

// Verifica se o ID do usuário foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do usuário no banco de dados
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "Usuário não encontrado.";
        exit();
    }
} else {
    echo "ID do usuário não fornecido.";
    exit();
}

// Processa o formulário de edição
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    // Atualiza os dados do usuário no banco de dados
    $stmt = $conn->prepare("UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->execute();

    // Redireciona de volta para a lista de usuários
    header("Location: usuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Editar Usuário</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        Nome: <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>" required><br>
        E-mail: <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required><br>
        Telefone: <input type="text" name="telefone" value="<?php echo $usuario['telefone']; ?>"><br>
        <input type="submit" name="editar" value="Salvar Alterações">
    </form>
    <br>
    <a href="usuarios.php">Voltar para a lista de usuários</a>
</body>
</html>