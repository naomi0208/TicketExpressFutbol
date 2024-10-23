<?php 
session_start(); 
require_once 'Controlador/BD/Conexion.php';
require_once 'Controlador/Dao/DEvento2.php';

$deve = new DEvento();

// Verificar si se han proporcionado parámetros de búsqueda en la URL
$categoria = isset($_GET['category']) && $_GET['category'] !== '' ? $_GET['category'] : null;
$ciudad = isset($_GET['city']) && $_GET['city'] !== '' ? $_GET['city'] : null;
$publico = isset($_GET['audience']) && $_GET['audience'] !== '' ? $_GET['audience'] : null;

// Obtener los eventos filtrados de la base de datos
$busqueda = [
    'categoria' => $categoria,
    'ciudad' => $ciudad,
    'publico' => $publico
];

$resultados = $deve->getBusqueda($busqueda);
$_SESSION["eventos"] = $resultados;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda</title>
    <link rel="icon" href="images/loguito.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>

<body>
    <div class="announcement-bar">
        <div class="announcement-bar-content container">
            <div class="content-info">
                <p>
                    <i class="fa-regular fa-envelope"></i>
                    ticketexpress_pe@gmail.com
                </p>
            </div>
            <div class="social-links">
                <a href="#" class="btn-social-link">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                <a href="#" class="btn-social-link">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="#" class="btn-social-link">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
            </div>
        </div>
    </div>
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

            <input type="checkbox" id="search-toggle" />
            <label for="search-toggle">
                <img src="images/lupa.png" class="search-icon" alt="Buscar"></label>
            <div class="search-bar">
                <form id="search-form" action="resultados_busqueda.php" method="GET">
                    <select id="category-filter" name="category" class="search-filters">
                        <option value="">Categoria</option>
                        <option value="concierto">Concierto</option>
                        <option value="teatro">Teatro</option>
                        <option value="deportes">Deportes</option>
                        <option value="entretenimiento">Entretenimiento</option>
                        <option value="otros">Otros</option>
                    </select>
                    <select id="city-filter" name="city" class="search-filters">
                        <option value="">Ciudad</option>
                        <option value="lima">Lima</option>
                        <option value="arequipa">Arequipa</option>
                        <option value="piura">Piura</option>
                    </select>
                    <button class="btn-3" id="search-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const searchButton = document.getElementById("search-button");
                    searchButton.addEventListener("click", function () {
                        const category = document.getElementById("category-filter").value;
                        const city = document.getElementById("city-filter").value;

                        const queryParams = new URLSearchParams();
                        if (category) queryParams.set("category", category);
                        if (city) queryParams.set("city", city);

                        const queryString = queryParams.toString();
                        window.location.href = "resultados_busqueda.php?" + queryString;
                    });
                });
            </script>

            <input type="checkbox" id="menu" />
            <label for="menu">
                <img src="images/menu.png" class="menu-icono" alt="">" </label>
            <nav class="navbar">
                <div class="menu-1">
                    <ul>
                        <li><a href="index.html">Inicio</a></li>
                        <li><a href="nosotros.html">Nosotros</a></li>
                        <li><a href="redes sociales.html">Redes Sociales</a></li>
                        <li><a href="mapas.html">Mapas</a></li>
                        <li><a href="contacto.html">Contacto</a></li>
                        <li><a href="contacto.html">Mis entradas</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <section class="busqueda">
        <div class="busqueda-content container">
            <div class="row">
                <?php
                function formatValue($value){
                    // Separar las palabras y capitalizar la primera letra de cada una
                    return ucwords(str_replace("-", " ", $value));
                }

                // Mostrar los resultados
                if (!empty($_SESSION["eventos"])) {
                    foreach ($_SESSION["eventos"] as $evento) {
                        echo "<div class='col mb-4'>";
                        echo "<div class='card'>";
                        echo "<img id='imagen-" . $evento["id_evento"] . "' src='" . $evento["imagen"] . "' class='card-img-top' alt='" . $evento["nombre_evento"] . "'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . $evento["nombre_evento"] . "</h5>";
                        echo "<p class='card-text'>Categoría: " . formatValue($evento["categoria"]) . "</p>";
                        echo "<p class='card-text'>Ciudad: " . formatValue($evento["ciudad"]) . "</p>";
                        echo "<button class='btn btn-primary' onclick='verDetalles(\"" . $evento["id_evento"] . "\")'>Ver detalles</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='card-body'><h5 class='card-title'>No se encontraron eventos que coincidan con los criterios de búsqueda.</p></div>";
                }
                ?>
            </div>
        </div>
    </section>

    <script>
        function verDetalles(id) {
            window.location.href = 'detalles_producto.php?id=' + id;
        }

        function mostrarVideo(id) {
            const imagen = document.getElementById(`imagen-${id}`);
            const video = document.getElementById(`video-${id}`);
            if (video) {
                video.style.display = 'block';                
                video.play();
                imagen.style.display = 'none';
            }
        }

        function ocultarVideo(id) {
            const imagen = document.getElementById(`imagen-${id}`);
            const video = document.getElementById(`video-${id}`);
            if (video) {
                video.pause();
                video.style.display = 'none';
                imagen.style.display = 'block';
            }
        }

        document.getElementById('menu').addEventListener('change', function () {
            if (this.checked) {
                document.getElementById('search-toggle').checked = false;
            }
        });

        document.getElementById('search-toggle').addEventListener('change', function () {
            if (this.checked) {
                document.getElementById('menu').checked = false;
            }
        });
    </script>

</body>

</html>