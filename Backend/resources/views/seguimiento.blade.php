<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento</title>
    @vite('resources/js/app.js') <!-- Incluir los assets generados por Vite -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <div id="seguimiento"></div> <!-- Aquí se montará Vue -->
</body>
</html>
