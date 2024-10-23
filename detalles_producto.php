<?php
session_start();

require_once('Controlador/BD/Conexion.php'); // Asegúrate de tener el archivo de conexión a la base de datos

// Obtener el ID del evento desde la URL
if (isset($_GET['id'])) {
    $id_evento = $_GET['id'];

    // Consultar la base de datos para obtener los detalles del evento
    $conexion = new Conexion();
    $query = "SELECT e.*, c.nombre_categoria, p.descripcion AS publico_descripcion
              FROM Eventos e
              LEFT JOIN Categoria c ON e.id_categoria = c.id_categoria
              LEFT JOIN Publico p ON e.id_publico = p.id_publico
              WHERE e.id_evento = :id_evento";
    
    $statement = $conexion->getcon()->prepare($query);
    $statement->bindParam(':id_evento', $id_evento, PDO::PARAM_STR);
    $statement->execute();
    
    $evento = $statement->fetch(PDO::FETCH_ASSOC);

} else {
    echo "ID de evento no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Evento</title>
    <link rel="icon" href="images/loguito.png">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="menu container">
            <div class="top-row">
                <div class="logo-container">
                    <img class="logo-1" src="images/logo.png" alt="" usemap="#mlogo">
                    <img class="logo-2" src="images/logo.png" alt="" usemap="#mlogo">
                    <map name="mlogo">
                        <area alt="Logotipo" title="TicketExpress" shape="rect" coords="0,0,150,60" href="index.html">
                    </map>
                </div>
            </div>
        </div>
    </header>

    <section class="detalle">
        <div class="evento-imagen" id="evento-imagen">
            <!-- Mostrar la imagen del evento -->
            <img src="<?php echo $evento['imagen']; ?>" alt="<?php echo $evento['nombre_evento']; ?>">
        </div>

        <div id="evento-detalle" class="zona-contenedor">
            <div id="mapa-container" class="zona-imagen">
                <img src="images/estadio.png" alt="Imagen estadio">
            </div>

            <div class="evento-detalle-info">
                <!-- Cuadros de zonas -->
                <div class="zona-info">
                    <table id="zona-precio">
                        <thead>
                            <tr>
                                <th>Zona</th>
                                <th>Precio</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="norte">
                                <td>Norte</td>
                                <td>S/50</td>
                                <td><button class="btn btn-primary" onclick="openReservationModal('Norte')" data-bs-toggle="modal" data-bs-target="#reservationModal">Seleccionar</button></td>
                            </tr>
                            <tr class="sur">
                                <td>Sur</td>
                                <td>S/50</td>
                                <td><button class="btn btn-primary" onclick="openReservationModal('Sur')" data-bs-toggle="modal" data-bs-target="#reservationModal">Seleccionar</button></td>
                            </tr>
                            <tr class="oriente">
                                <td>Oriente</td>
                                <td>S/75</td>
                                <td><button class="btn btn-primary" onclick="openReservationModal('Oriente')" data-bs-toggle="modal" data-bs-target="#reservationModal">Seleccionar</button></td>
                            </tr>
                            <tr class="occidente">
                                <td>Occidente</td>
                                <td>S/75</td>
                                <td><button class="btn btn-primary" onclick="openReservationModal('Occidente')" data-bs-toggle="modal" data-bs-target="#reservationModal">Seleccionar</button></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Primer Modal: Formulario de reserva -->
                    <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="reservationModalLabel">Haz tu reserva en Zona: </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="reservationForm">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nombres</label>
                                            <input type="text" class="form-control" id="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Apellidos</label>
                                            <input type="text" class="form-control" id="lastname" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dni" class="form-label">DNI</label>
                                            <input type="text" class="form-control" id="dni" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Correo</label>
                                            <input type="email" class="form-control" id="email" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#successModal" onclick="confirmReservation()">Confirmar Reserva</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Segundo Modal: Confirmación de éxito -->
                    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="successModalLabel">¡Reserva realizada con éxito!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Tu reserva fue realizada con éxito.</p>
                                    <p>Este es tu código de reserva: <strong id="reservationCode"></strong></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="JS/script.js"></script>
    <script>
        // Función para abrir el modal de reserva con la zona seleccionada
        function openReservationModal(zona) {
            document.getElementById("reservationModalLabel").innerText = "Haz tu reserva en Zona: " + zona;
        }
        // Función para confirmar la reserva y generar el código
        function confirmReservation() {
            let code = generateReservationCode();
            document.getElementById("reservationCode").innerText = code;
            new bootstrap.Modal(document.getElementById('successModal')).show();
        }

        function generateReservationCode() {
            return Math.random().toString(36).substring(2, 10).toUpperCase();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>