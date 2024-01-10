<?php
include('crud.php');

// Verificar si se envió el formulario de agregar jugador
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addPlayer'])) {
    // Obtener datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $equipo = $_POST['equipo'];
    $posicion = $_POST['posicion'];
    $categoria = $_POST['categoria'];
    $edad = $_POST['edad'];
    $numero = $_POST['numero'];

    // Llamar a la función para agregar jugador
    addPlayer($id, $nombre, $equipo, $posicion, $categoria, $edad, $numero);
}

// Verificar si se envió el formulario de actualizar jugador
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePlayer'])) {
    // Obtener datos del formulario
    $id = $_POST['updatePlayer'];
    $nombre = $_POST['nombre'];
    $equipo = $_POST['equipo'];
    $posicion = $_POST['posicion'];
    $categoria = $_POST['categoria'];
    $edad = $_POST['edad'];
    $numero = $_POST['numero'];

    // Llamar a la función para actualizar jugador
    updatePlayer($id, $nombre, $equipo, $posicion, $categoria, $edad, $numero);
}

// Verificar si se envió el formulario de eliminar jugador
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletePlayer'])) {
    // Obtener el ID del jugador a eliminar
    $id = $_POST['deletePlayer'];

    // Llamar a la función para eliminar jugador
    deletePlayer($id);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Jugadores</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Agregar Jugadores</h1>

    <!-- Formulario para agregar jugador -->
    <form method="post" action="">
        <label for="id">ID:</label>
        <input type="text" name="id" required>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required minlength="3">
        <label for="equipo">Equipo:</label>
        <input type="text" name="equipo" required>
        <label for="posicion">Posición:</label>
        <input type="text" name="posicion" required>
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" required>
        <label for="edad">Edad:</label>
        <input type="text" name="edad" required>
        <label for="numero">Número:</label>
        <input type="text" name="numero" required>
        <button type="submit" name="addPlayer">Agregar Jugador</button>
    </form>

</div>

</body>
</html>
