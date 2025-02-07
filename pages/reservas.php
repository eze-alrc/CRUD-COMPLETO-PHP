<?php
include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Reservas</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Gerenciar Reservas</h1>
    <form method="post">
        Usuário: 
        <select name="usuario_id" required>
            <?php
            $usuarios = $conn->query("SELECT * FROM usuarios");
            foreach ($usuarios as $usuario) {
                echo "<option value='{$usuario['id']}'>{$usuario['nome']}</option>";
            }
            ?>
        </select><br>
        Espaço: 
        <select name="espaco_id" required>
            <?php
            $espacos = $conn->query("SELECT * FROM espacos");
            foreach ($espacos as $espaco) {
                echo "<option value='{$espaco['id']}'>{$espaco['nome']}</option>";
            }
            ?>
        </select><br>
        Data: <input type="date" name="data_reserva" required><br>
        Hora Início: <input type="time" name="hora_inicio" required><br>
        Hora Fim: <input type="time" name="hora_fim" required><br>
        <input type="submit" name="reservar" value="Reservar">
    </form>

    <?php
    if (isset($_POST['reservar'])) {
        $usuario_id = $_POST['usuario_id'];
        $espaco_id = $_POST['espaco_id'];
        $data_reserva = $_POST['data_reserva'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fim = $_POST['hora_fim'];

        // Verificar disponibilidade
        $stmt = $conn->prepare("SELECT * FROM reservas WHERE espaco_id = :espaco_id AND data_reserva = :data_reserva AND ((hora_inicio <= :hora_inicio AND hora_fim > :hora_inicio) OR (hora_inicio < :hora_fim AND hora_fim >= :hora_fim))");
        $stmt->bindParam(':espaco_id', $espaco_id);
        $stmt->bindParam(':data_reserva', $data_reserva);
        $stmt->bindParam(':hora_inicio', $hora_inicio);
        $stmt->bindParam(':hora_fim', $hora_fim);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<p>Conflito de horário. Por favor, escolha outro horário.</p>";
        } else {
            $stmt = $conn->prepare("INSERT INTO reservas (usuario_id, espaco_id, data_reserva, hora_inicio, hora_fim) VALUES (:usuario_id, :espaco_id, :data_reserva, :hora_inicio, :hora_fim)");
            $stmt->bindParam(':usuario_id', $usuario_id);
            $stmt->bindParam(':espaco_id', $espaco_id);
            $stmt->bindParam(':data_reserva', $data_reserva);
            $stmt->bindParam(':hora_inicio', $hora_inicio);
            $stmt->bindParam(':hora_fim', $hora_fim);
            $stmt->execute();
            echo "<p>Reserva realizada com sucesso!</p>";
        }
    }

    $reservas = $conn->query("SELECT reservas.*, usuarios.nome as usuario_nome, espacos.nome as espaco_nome FROM reservas JOIN usuarios ON reservas.usuario_id = usuarios.id JOIN espacos ON reservas.espaco_id = espacos.id");
    echo "<h2>Reservas Realizadas</h2>";
    echo "<ul>";
    foreach ($reservas as $reserva) {
        echo "<li>{$reserva['usuario_nome']} reservou {$reserva['espaco_nome']} em {$reserva['data_reserva']} das {$reserva['hora_inicio']} às {$reserva['hora_fim']} <a href='cancelar_reserva.php?id={$reserva['id']}' class='button delete'>Cancelar</a></li>";
    }
    echo "</ul>";
    ?>
</body>
</html>