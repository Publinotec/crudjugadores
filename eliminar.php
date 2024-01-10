<?php
include('crud.php');

// Variables para llenar el formulario
$id = '';
$nombre = '';
$equipo = '';
$posicion = '';
$categoria = '';
$edad = '';
$numero = '';

// Verificar si se envió el formulario con el ID
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteId'])) {
    // Obtener el ID del formulario
    $idForm = $_POST['deleteId'];

    // Obtener datos del jugador por ID
    $playerData = getJugadorById($idForm);

    if ($playerData) {
        // Si el jugador existe, llenar las variables
        $id = $playerData['id'];
        $nombre = $playerData['nombre'];
        $equipo = $playerData['equipo'];
        $posicion = $playerData['posicion'];
        $categoria = $playerData['categoria'];
        $edad = $playerData['edad'];
        $numero = $playerData['numero'];
    }
}

// Verificar si se envió el formulario de eliminar jugador
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletePlayer'])) {
    // Obtener el ID del jugador a eliminar
    $id = $_POST['deletePlayer'];

    // Eliminar el jugador de la base de datos
    deletePlayer($id);

     // Redirigir a la página index.html después de 2 segundos
     header("refresh:2;url=index.html");

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Jugador</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Eliminar Jugador</h1>

  

        <!-- Formulario para cargar jugador por ID -->
    <form method="post" action="">
        <label for="deleteId">ID del Jugador:</label>
        <input type="text" name="deleteId" required>
        <button type="submit">Cargar Jugador por ID</button>
    </form>

    <form method="post" action="">
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
        <button type="submit">Cargar Jugador por Id</button>
    </form>

    <!-- Formulario para eliminar jugador -->
    <?php if ($id): ?>
        <form method="post" action="">
            <input type="hidden" name="deletePlayer" value="<?php echo $id; ?>">
            <p>¿Seguro que quieres eliminar a <?php echo $nombre; ?>?</p>
            <button type="submit">Eliminar Jugador</button>
        </form>
 
    <?php endif; ?>
       <!-- Enlace con Imagen -->
       <a href="index.html">
            <img src="images/regresar.png" alt="Regresar a Index" style="width: 150px; height: auto;">
        </a>
</div>

</body>
</html>
