<?php
// Conexión a la base de datos
session_start();
$host = "bqkml1hdkjdnadoq0zdw-mysql.services.clever-cloud.com";
$user = "uk7qfvzrwmladkaa";
$password = "UkI7cvDtUOvLgN9viytH";
$database = "bqkml1hdkjdnadoq0zdw";

$conexion = mysqli_connect($host, $user, $password, $database);
if (!$conexion) {
    echo "No se realizó la conexión a la base de datos, el error fue:" . mysqli_connect_error();
} else {
    $username = $_POST["Matricula"];
    $password = $_POST["Contrasena"];

    // Evita la inyección SQL utilizando consultas preparadas
    $sql = "SELECT Matricula, Nombre, Contrasena
            FROM usuario
            WHERE Matricula = ? AND Contrasena = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("is", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($matricula, $nombre, $contrasena);
        $stmt->fetch();
        
        // Si hay resultados en la consulta, significa que las credenciales son correctas.
        // Asigna la matrícula y el nombre a las variables de sesión y luego redirige
        $_SESSION['Matricula'] = $matricula;
        $_SESSION['Nombre'] = $nombre;
        header("Location: views/index2.php");
        exit();
    } else {
        // Credenciales incorrectas, redirige de nuevo al formulario de inicio de sesión con un mensaje de error
        header("Location: index.html?error=1");
        echo "Acceso denegado";
        exit();
    }
}
?>
