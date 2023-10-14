<?php
session_start();
$matricula = $_SESSION['Matricula'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUBIR WORD & PDF</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilos.css">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="col-sm-12">
            <!-- Titulo -->
            <h2 class="mt-5 mb-4" style="text-align: center;">Subir Archivos Word & PDF</h2>
            <!-- Boton de envio -->         
            <div class="s">
              <h4>Matrícula: <?php echo $_SESSION['Matricula'];?></h4>
              <h4>Nombre: <?php echo $_SESSION['Nombre'];?></h4>
              <button type="button" class="btn btn-danger"><a href="../index.html"> Cerrar Sesion</a></button>
            </div>



            <div>
                <button type="button" class="btn btn-success px-3 mb-4" data-toggle="modal" data-target="#agregar"> Agregar </button>
            </div>
            <!-- Tabla de contenido, apoyado con la BD trapada en la nube -->
            <div class="container">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <!-- Etiquesa superior de la tabla -->
                        <tr>
                            <th>Titulo</th>
                            <th>Instruccion</th>
                            <th>Calificacion</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Imprimir onfromacion de la BD a la tabla -->
                       <?php
                       require_once "../includes/db.php";
                       // u = usuario || t = conexion_T_C || f = tareas || i = intrucciones //
                        $consulta = mysqli_query($conexion, "SELECT u.*, t.*, f.*, e.*, i.* FROM usuario u
                        -- Reconoce ||    Tabla    ||    FK    ||    PK    ||
                        inner join conexion_T_C t ON u.Matricula = t.ID_Matricula 
                        inner join tareas f ON t.ID_Tarea = f.ID_Tarea
                        inner join calificaciones e ON f.ID_Cali = e.ID_Cali
                        inner join instrucciones i ON f.ID_Itrccs = i.ID_Itrccs
                        where u.Matricula = '$matricula'");
                        // Muestra el contenido de la otra tabla.
                       while ($fila = mysqli_fetch_assoc($consulta)):
                        
                        
                       ?>
                            <tr>
                            <td><?php echo $fila['Archivo'] ;?></td>    <!--Titulo-->
                            <td><?php echo $fila['Instruccion'] ;?></td><!--Intruccion-->
                            <td><?php echo $fila['Calificacion'] ;?></td><!--Calificacion-->
                                <td>    <!--Descarga-->
                                    <a href="../includes/deleted.php?Ruta_archivo= <?php echo $fila['ID_Tarea'] ;?>" class="btn btn-danger">Eliminar</a>
                                </td>
                                <?php endwhile ;?>

                            </tr>
                    </tbody>
                </table>

            </div>
        </div>
</body>
<style>
    a {
        text-decoration: none;
    }

</style>

<!-- Permite ejecutar el archivo que muestra una ventana flotante para subir los archivos -->
<?php include "agregar.php"; ?>

</html>