<?php
include '../includes/db.php';

// Verifica se o ID do usuário foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exclui o usuário do banco de dados
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Redireciona de volta para a lista de usuários
    header("Location: usuarios.php");
    exit();
} else {
    echo "ID do usuário não fornecido.";
    exit();
}
?>