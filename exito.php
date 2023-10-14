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
      <!-- Parametros -->
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
      <h1>completado</h1>
   </div>
</body>
</html>