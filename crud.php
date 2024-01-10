<?php
include('config.php');

// Función para obtener todos los jugadores
function getAllPlayers() {
    global $conn;
    $result = $conn->query("SELECT * FROM jugadores");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Función para agregar un jugador
function addPlayer($id, $nombre, $equipo, $posicion, $categoria, $edad, $numero) {
    global $conn;

    // Verificar si el ID ya existe en la base de datos
    $existingPlayer = getJugadorById($id);
    if ($existingPlayer) {
        // El jugador con el mismo ID ya existe
        echo json_encode(array('error' => 'El jugador con el ID ' . $id . ' ya existe en la base de datos'));
        return false;
    }

    // El ID no existe, proceder con la inserción
    $stmt = $conn->prepare("INSERT INTO jugadores (id, nombre, equipo, posicion, categoria, edad, numero) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssis", $id, $nombre, $equipo, $posicion, $categoria, $edad, $numero);

    if ($stmt->execute()) {
        // Jugador agregado correctamente
        echo json_encode(array('message' => 'Jugador agregado correctamente'));

        // Redirigir a la página index.html después de 2 segundos
        header("refresh:2;url=index.html");

        return $stmt->insert_id;
    } else {
        // Manejar errores de la consulta preparada
        echo json_encode(array('error' => 'Error al insertar el jugador'));
        return false;
    }
}


// Función para obtener un jugador por ID
function getJugadorById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM jugadores WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}


// Función para actualizar un jugador y obtener los datos actualizados
function updatePlayer($id, $nombre, $equipo, $posicion, $categoria, $edad, $numero) {
    global $conn;

    // Obtener los datos actuales del jugador antes de la actualización
    $currentPlayer = getPlayerById($id);

    if ($currentPlayer) {
        // Guardar los valores actuales antes de la actualización
        $currentNombre = $currentPlayer['nombre'];
        $currentEquipo = $currentPlayer['equipo'];
        $currentPosicion = $currentPlayer['posicion'];
        $currentCategoria = $currentPlayer['categoria'];
        $currentEdad = $currentPlayer['edad'];
        $currentNumero = $currentPlayer['numero'];

        // Verificar si hay cambios en los datos
        if ($nombre !== $currentNombre || $equipo !== $currentEquipo || $posicion !== $currentPosicion ||
            $categoria !== $currentCategoria || $edad !== $currentEdad || $numero !== $currentNumero) {
            
            // Realizar la actualización en la base de datos
            $stmt = $conn->prepare("UPDATE jugadores SET nombre=?, equipo=?, posicion=?, categoria=?, edad=?, numero=? WHERE id=?");
            $stmt->bind_param("ssssiii", $nombre, $equipo, $posicion, $categoria, $edad, $numero, $id);

            if ($stmt->execute()) {
                // Obtener los datos actualizados después de la actualización
                $updatedPlayer = getPlayerById($id);
                return $updatedPlayer;
            } else {
                // Manejar errores de la consulta preparada
                return null;
            }
        } else {
            // No hay cambios en los datos, simplemente devolver los datos actuales
            return $currentPlayer;
        }
    } else {
        // El jugador no existe, devolver mensaje de error
        return array('error' => 'El jugador con ID ' . $id . ' no existe.');
    }
}


// Función para actualizar un jugador por ID
function updatePlayerById($id, $nombre, $equipo, $posicion, $categoria, $edad, $numero) {
    global $conn;
    $stmt = $conn->prepare("UPDATE jugadores SET nombre=?, equipo=?, posicion=?, categoria=?, edad=?, numero=? WHERE id=?");
    $stmt->bind_param("ssssiii", $nombre, $equipo, $posicion, $categoria, $edad, $numero, $id);
    $stmt->execute();
}

// Función para actualizar un jugador por nombre
function updatePlayerByName($nombre, $equipo, $posicion, $categoria, $edad, $numero) {
    global $conn;
    $stmt = $conn->prepare("UPDATE jugadores SET equipo=?, posicion=?, categoria=?, edad=?, numero=? WHERE nombre=?");
    $stmt->bind_param("ssssis", $equipo, $posicion, $categoria, $edad, $numero, $nombre);
    $stmt->execute();
}




// Función para eliminar un jugador
function deletePlayer($id) {
    global $conn;
    $conn->query("DELETE FROM jugadores WHERE id=$id");
}
?>
