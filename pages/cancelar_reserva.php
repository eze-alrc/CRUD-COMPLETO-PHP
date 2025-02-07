<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Exclui a reserva
        $stmt = $conn->prepare("DELETE FROM reservas WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<p>Reserva cancelada com sucesso!</p>";
    } catch (PDOException $e) {
        echo "<p>Erro ao cancelar reserva: " . $e->getMessage() . "</p>";
    }

    // Redireciona de volta para a lista de reservas
    header("Refresh: 2; url=reservas.php");
    exit();
} else {
    echo "<p>ID da reserva não fornecido.</p>";
    exit();
}
?>