<?php
include 'config.php';

// Verificar si la solicitud es de tipo GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Realizar una consulta SELECT para obtener todos los jugadores
    $result = $conn->query("SELECT * FROM jugadores");

    if ($result) {
        // Convertir el resultado a un array asociativo y devolverlo como JSON
        $players = $result->fetch_all(MYSQLI_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($players);
    } else {
        // Manejar errores de la consulta SELECT
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Error al obtener los jugadores: ' . $conn->error));
    }
} else {
    // Manejar el caso donde la solicitud no es de tipo GET
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Solicitud no válida. Se esperaba una solicitud GET.'));
}

// Cerrar la conexión
$conn->close();
?>
