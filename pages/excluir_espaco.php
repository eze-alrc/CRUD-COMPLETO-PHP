<?php
include '../includes/db.php';

// Verifica se o ID do espaço foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exclui o espaço do banco de dados
    $stmt = $conn->prepare("DELETE FROM espacos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Redireciona de volta para a lista de espaços
    header("Location: espacos.php");
    exit();
} else {
    echo "ID do espaço não fornecido.";
    exit();
}
?>