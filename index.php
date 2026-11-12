<?php
$conexion = new mysqli("localhost", "root", "", "cafeteria_505");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8mb4");
$respuesta = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["guardar"])) {
        $nombre = trim($_POST["nombre"] ?? "");
        $correo = trim($_POST["correo"] ?? "");
        $mensaje = trim($_POST["mensaje"] ?? "");

        if ($nombre == "" || $correo == "" || $mensaje == "") {
            $respuesta = "Todos los campos son obligatorios.";
        } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $respuesta = "El correo no es válido.";
        } else {
            $sql = "INSERT INTO clientes (nombre, correo, mensaje) VALUES (?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            if (!$stmt) {
                $respuesta = "Error SQL: " . $conexion->error;
            } else {
                $stmt->bind_param("sss", $nombre, $correo, $mensaje);
                if ($stmt->execute()) {
                    $respuesta = "¡Registro guardado correctamente! Bienvenido, " . urlencode($nombre);
                } else {
                    $respuesta = "Error al guardar: " . $stmt->error;
                }
                $stmt->close();
            }
        }
    } 
    elseif (isset($_POST["eliminar"])) {
        $correo = trim($_POST["correo"] ?? "");

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $respuesta = "El correo electrónico no es válido.";
        } else {
            $sql = "DELETE FROM clientes WHERE correo = ? LIMIT 1";
            $stmt = $conexion->prepare($sql);
            if (!$stmt) {
                $respuesta = "Error SQL: " . $conexion->error;
            } else {
                $stmt->bind_param("s", $correo);
                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        $respuesta = "¡Registro eliminado correctamente!";
                    } else {
                        $respuesta = "No se encontró el correo indicado.";
                    }
                } else {
                    $respuesta = "Error al eliminar: " . $stmt->error;
                }
                $stmt->close();
            }
        }
    }
}

$conexion->close();

header("Location: index.html?msg=" . urlencode($respuesta));
exit();
?>