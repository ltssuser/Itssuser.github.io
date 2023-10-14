<?php
// ELIMINAR ARCHIVOS

// Llama a la BD que está en la nube
include "db.php";

// Obtener el ID de la tarea desde la URL
$id = isset($_GET['Ruta_archivo']) ? $_GET['Ruta_archivo'] : null;

if (!is_numeric($id)) {
    die("ID no válido"); // Manejo de ID no válido
}

// Consulta para obtener el ID de calificación relacionado con la tarea
$sql0 = "SELECT ID_Cali FROM tareas WHERE ID_Tarea = $id";
$result0 = mysqli_query($conexion, $sql0);

if (!$result0) {
    die("Error al obtener el ID de calificación: " . mysqli_error($conexion));
}

$row = mysqli_fetch_assoc($result0);
$IDCali = $row['ID_Cali'];

// Eliminar registros de las tablas

$sql2 = "DELETE FROM conexion_T_C WHERE ID_Tarea = $id";
$sql3 = "DELETE FROM tareas WHERE ID_Tarea = $id";
$sql1 = "DELETE FROM calificaciones WHERE ID_Cali = $IDCali";

if (
    mysqli_query($conexion, $sql2) &&
    mysqli_query($conexion, $sql3) &&
    mysqli_query($conexion, $sql1)
) {
    echo "Registros eliminados correctamente.";
    header("Location: ../views/index2.php");
} else {
    echo "Error al eliminar registros: " . mysqli_error($conexion);
    header("Location: ../index.html");
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
