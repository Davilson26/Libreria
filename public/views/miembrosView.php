<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gestión de Usuarios</h1>
    <form id="userForm">
        <input type="hidden" id="userId">
        <input type="text" id="userName" placeholder="Nombre" required>
        <input type="tel" id="telefono" placeholder="Telefono" required>
        <input type="email" id="userEmail" placeholder="Correo Electrónico" required>
        <button type="submit">Guardar Usuario</button>
    </form>

    <h2>Lista de Usuarios</h2>
    <ul id="userList"></ul>

    <script src="miembrosModule.js"></script>
</body>
</html>