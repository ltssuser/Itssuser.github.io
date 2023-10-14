<?php
session_start();
echo $_SESSION['Matricula'];
include 'db.php';

if (isset($_FILES['Archivo'])) {
    extract($_POST);
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['Instruccion'];

    // Obtener el contenido del archivo PDF
    $pdfData = file_get_contents($_FILES["Archivo"]["tmp_name"]);

    $sql2 = "INSERT INTO calificaciones (Calificacion) VALUES ('0')";
    $resultado3 = mysqli_query($conexion, $sql2);
    $idnewcali = mysqli_insert_id($conexion);

    // Preparar la consulta SQL para insertar los bytes en la base de datos
    $sql1 = "INSERT INTO tareas (Archivo, Rutas, ID_Itrccs, ID_Cali, ID_Status) VALUES (?, ?, ?, ?, ?)";
    $statement1 = $conexion->prepare($sql1);
    $ID_Status = '1';
    $statement1->bind_param("sssii", $nombre, $pdfData, $descripcion, $idnewcali, $ID_Status);

    // Ejecutar la consulta
    if ($statement1->execute()) {
        $idnewtarea = mysqli_insert_id($conexion);
        $sql3 = "INSERT INTO conexion_T_C (ID_Tarea, ID_Matricula) VALUES (?, ?)";
        $statement2 = $conexion->prepare($sql3);

        // Verifica si la preparación de la consulta fue exitosa
        if ($statement2) {
            $statement2->bind_param("ii", $idnewtarea, $_SESSION['Matricula']); // Corregido $_SESSION
        
            // Ejecutar la consulta
            if ($statement2->execute()) {
                if ($resultado3) {
                    echo "<script language='JavaScript'>
                        alert('Archivo Subido');
                        location.assign('../views/index2.php');
                        </script>";
                } else {
                    echo "<script language='JavaScript'>
                        alert('Error al insertar el archivo en la tabla de tareas.');
                        location.assign('../views/index2.php');
                        </script>";
                }

                // Cerrar la conexión y las declaraciones
                $statement2->close();
                $statement1->close();
                $conexion->close();
            } else {
                echo "Error al ejecutar la consulta: " . $conexion->error;
            }
        } else {
            echo "Error al preparar la consulta: " . $conexion->error;
        }
    } else {    
        echo "Error al almacenar el PDF: " . $conexion->error;
    } 
} else {
    echo "<script language='JavaScript'>
        alert('No se ha cargado un archivo.');
        location.assign('../views/index2.php');
        </script>";
}
?>
