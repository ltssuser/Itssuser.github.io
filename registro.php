<?php
include 'includes/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
   $matricula = $_POST["matricula"];
   $nombre = $_POST["nombre"];
   $apellidoPaterno = $_POST["apellido_paterno"];
   $apellidoMaterno = $_POST["apellido_materno"];
   $telefono = $_POST["telefono"];
   $correoElectronico = $_POST["correo_electronico"];
   $contrasena = $_POST["contrasena"];
   $semestre = $_POST["semestre"];
   $carrera = $_POST["carrera"];
   $edad = $_POST["edad"];

   // Inserción en la tabla de teléfono (cambia el nombre de la tabla a 'telefono')
   $sqlTelefono = "INSERT INTO telefono (Telefono) VALUES (?)"; // Cambio en el nombre de la tabla
   $stmtTelefono = mysqli_prepare($conexion, $sqlTelefono);
   if ($stmtTelefono) {
       mysqli_stmt_bind_param($stmtTelefono, "s", $telefono);
       mysqli_stmt_execute($stmtTelefono);
       $idTelefono = mysqli_insert_id($conexion);
   } else {
       die("Error al preparar la consulta de teléfono: " . mysqli_error($conexion));
   }

   // Inserción en la tabla de correos (cambia el nombre de la tabla a 'correo')
   $sqlCorreo = "INSERT INTO correos (Correo_electronico) VALUES (?)"; // Cambio en el nombre de la tabla
   $stmtCorreo = mysqli_prepare($conexion, $sqlCorreo);
   if ($stmtCorreo) {
       mysqli_stmt_bind_param($stmtCorreo, "s", $correoElectronico);
       mysqli_stmt_execute($stmtCorreo);
       $idCorreo = mysqli_insert_id($conexion);
   } else {
       die("Error al preparar la consulta de correo: " . mysqli_error($conexion));
   }

  // Asegúrate de que todas las variables estén definidas y tengan valores válidos
if (isset($matricula, $nombre, $apellidoPaterno, $apellidoMaterno, $idTelefono, $idCorreo, $semestre, $carrera, $contrasena, $edad)) {
   // Inserción en la tabla de usuario
   $sqlUsuario = "INSERT INTO usuario (Matricula, Nombre, Apellido_P, Apellido_M, ID_Cel, ID_Email, ID_Sem, ID_Car, Contrasena, Edad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
   $stmtUsuario = mysqli_prepare($conexion, $sqlUsuario);
   
   if ($stmtUsuario) {
       mysqli_stmt_bind_param($stmtUsuario, "ssssiiiisi", $matricula, $nombre, $apellidoPaterno, $apellidoMaterno, $idTelefono, $idCorreo, $semestre, $carrera, $contrasena, $edad);
       if (mysqli_stmt_execute($stmtUsuario)) {
           // La consulta se ejecutó con éxito
           mysqli_close($conexion);
           header("Location: exito.php"); // Redirige a una página de éxito
           exit();
       } else {
           // Error en la ejecución de la consulta
           die("Error al ejecutar la consulta de usuario: " . mysqli_error($conexion));
       }
   } else {
       // Error en la preparación de la consulta
       die("Error al preparar la consulta de usuario: " . mysqli_error($conexion));
   }
} else {
   // Alguna de las variables está indefinida o no tiene un valor válido
   die("Error: Alguna variable no está definida o no tiene un valor válido.");
}
   
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registro de datos</title>
   <link rel="stylesheet" href="css/estilos.css">
   <style>
      h1 {
         font-size: 48px;
         font-weight: bold;
         color: #1664b1;
      }
   </style>
   <script>
      // Parametros
      function soloTexto(event) {
         const input = event.target;
         const valor = input.value;
         input.value = valor.replace(/[^A-Za-záéíóúÁÉÍÓÚ\s]/g, '');
      }
      function soloNumeros(event) {
         const input = event.target;
         const valor = input.value;
         input.value = valor.replace(/\D/g, ''); 
      }
   </script>
</head>
<body>
   <!-- Cuestionario -->
   <div class="contenedor">
      <h1>Registro de datos</h1>
      <form method="post">
         
         <input type="text" name="matricula" placeholder="Matricula" maxlength="8" oninput="soloNumeros(event);">
         <input type="text" name="nombre" placeholder="Nombre" maxlength="30" oninput="soloTexto(event);">
         <input type="text" name="apellido_paterno" placeholder="Apellido Paterno" maxlength="30" oninput="soloTexto(event);">
         <input type="text" name="apellido_materno" placeholder="Apellido Materno" maxlength="30" oninput="soloTexto(event);">
         <input type="text" name="telefono" placeholder="Teléfono" maxlength="10" oninput="soloNumeros(event);">
         <input type="text" name="edad" placeholder="Edad" maxlength="2" oninput="soloNumeros(event);">
         <input type="text" name="correo_electronico" placeholder="Correo Electronico" maxlength="40" pattern=".*@(gmail\.com|hotmail\.com)">
         <input type="password" name="contrasena" placeholder="Contraseña" maxlength="10">
    
         <div class="Semestre">
            <h2>Semestre</h2>
               <select name="semestre" >
               <option value="">Seleccionar</option>
                <option value="1">Primero</option>
                <option value="2">Segundo</option>
               </select>
         </div>
         <div class="Carrera">
            <h2>Carrera</h2>
               <select name="carrera">
               <option value="">Seleccionar</option>
                 <option value="1">Sistemas</option>
                 <option value="2">Administración</option>
               </select>
         </div>
         <!-- Botón de envío -->
         <button type="submit">Guardar Datos</button>
      </form>
   </div>
</body>
</html>

<style>

    body{
        
    background-image: url(../images/back.jpg);
    }
</style>
