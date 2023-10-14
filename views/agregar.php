
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel">Agregar registro</h3>
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>

            <?php
            $servername = "bqkml1hdkjdnadoq0zdw-mysql.services.clever-cloud.com";
            $username = "uk7qfvzrwmladkaa";
            $password = "UkI7cvDtUOvLgN9viytH";
            $database = "bqkml1hdkjdnadoq0zdw";
            $conexion = mysqli_connect($servername, $username, $password, $database);
            if (!$conexion) {
                die("Error al conectar a la base de datos: " . mysqli_connect_error());
                echo "Fallo de conexion vuelva despues";
                header("Location: ../index.php");
                exit();
            }
            $query = "SELECT ID_Itrccs, Titulo FROM instrucciones";
            $resultado = mysqli_query($conexion, $query);

            if (!$resultado) {
                die("Error al consultar la base de datos: " . mysqli_error($conexion));
            }
            ?>

            <div class="modal-body">

                <form action="../includes/upload.php" method="POST" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Titulo</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>

                            </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Instrucción</label>
                            <select name="Instruccion" class="form-control" required>
                                <option value="">Selecciona una instrucción</option>
                                <?php
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value='{$fila['ID_Itrccs']}'>{$fila['Titulo']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                   </div>
                    
                    



                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Archivo (WORD & PDF)</label>
                        <input type="file" name="Archivo" id="Archivo" class="form-control" required>
                    </div>

                    <br>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="register" name="registrar">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>