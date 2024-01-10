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

     // Redirigir a la página Index.html después de 2 segundos
     header("refresh:2;url=index.html");
}

// Verificar si se envió el formulario de eliminar jugador
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletePlayer'])) {
    // Obtener el ID del jugador a eliminar
    $id = $_POST['deletePlayer'];

    // Llamar a la función para eliminar jugador
    deletePlayer($id);
}

// Función para obtener los datos de un jugador por ID
function getPlayerById($id) {
    global $conn;
    $result = $conn->query("SELECT * FROM jugadores WHERE id = '$id'");
    return $result->fetch_assoc();
}

// Variables para llenar el formulario
$id = '';
$nombre = '';
$equipo = '';
$posicion = '';
$categoria = '';
$edad = '';
$numero = '';

// Verificar si se envió el formulario con el ID
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateId'])) {
    // Obtener el ID del formulario
    $idForm = $_POST['updateId'];

    // Obtener datos del jugador por ID
    $playerData = getPlayerById($idForm);

    if ($playerData) {
        // Si el jugador existe, llenar las variables
        $id = $playerData['id'];
        $nombre = $playerData['nombre'];
        $equipo = $playerData['equipo'];
        $posicion = $playerData['posicion'];
        $categoria = $playerData['categoria'];
        $edad = $playerData['edad'];
        $numero = $playerData['numero'];
    } else {
        // Si el jugador no existe, mostrar un mensaje
        echo "El jugador con ID $idForm no existe.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta jugadores</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Consultar jugadores por Id</h1>

    <!-- Formulario para cargar jugador por ID -->
    <form method="post" action="">
        <label for="updateId">ID del Jugador:</label>
        <input type="text" name="updateId" required>
        <button type="submit">Cargar Jugador por ID</button>
    </form>

    <!-- Formulario para actualizar jugador -->
    <form method="post" action="">
        <input type="hidden" name="updatePlayer" value="<?php echo $id; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>" required>
        <label for="equipo">Equipo:</label>
        <input type="text" name="equipo" value="<?php echo $equipo; ?>" required>
        <label for="posicion">Posición:</label>
        <input type="text" name="posicion" value="<?php echo $posicion; ?>" required>
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" value="<?php echo $categoria; ?>" required>
        <label for="edad">Edad:</label>
        <input type="text" name="edad" value="<?php echo $edad; ?>" required>
        <label for="numero">Número:</label>
        <input type="text" name="numero" value="<?php echo $numero; ?>" required>
        <button type="submit">Actualizar Jugador</button>
    </form>
            <!-- Enlace con Imagen -->
            <a href="index.html">
            <img src="images/regresar.png" alt="Regresar a Index" style="width: 150px; height: auto;">
        </a>

</div>

</body>
</html>
