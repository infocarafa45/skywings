<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>SkyWings Travel</title>
    <link rel="shortcut icon" href="imagenes/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Encabezado -->
    <header class="main-header">
        <div class="header-content">
            <h1>🌍 SkyWings Travel</h1>
            <p>Encuentra las mejores tarifas para viajar!</p>
            <!-- Barra de navegación -->
            <nav>
                <?php if (isset($_SESSION["user_id"])): ?>
                <p>Hola, <?php echo $_SESSION["user_name"]; ?> | <a href="logout.php">Cerrar Sesión</a></p>
                <?php else: ?>
                <div class="nav-buttons">
                    <a href="login.php" class="cta-btn">Iniciar Sesión</a>
                    <a href="register.php" class="cta-btn">Registrarse</a>
                </div>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main>
        <?php if (isset($_SESSION["user_id"])): ?>
        <!-- Vuelos disponibles -->

        <section id="flights">
            <h2 align="center">Vuelos Disponibles</h2>

            <!-- 🔍 Buscador dinámico -->
            <div style="text-align:center; margin-bottom:20px;">
                <input type="text" id="search" placeholder="Buscar destino u origen...">
            </div>

            <!-- Contenedor de resultados -->
            <div class="flight-list" id="flight-results">
                <!-- Aquí se cargarán los vuelos vía AJAX -->
            </div>
        </section>
        <?php else: ?>
        <!-- Hero Section -->
        <section class="hero">
            <h2>Descubre el mundo con SkyWings Travel ✈️</h2>
            <p>Los mejores precios y destinos esperándote. Regístrate gratis y comienza tu aventura.</p>
            <a href="register.php" class="cta-btn">Registrarse Ahora</a>
        </section>

        <!-- Destinos Populares -->
        <section class="popular-destinations">
            <h2>🌍 Destinos Populares</h2>
            <div class="destinations-grid">
                <div class="destination">
                    <img src="imagenes/paris.jpg" alt="Paris">
                    <h3>París</h3>
                    <p>La ciudad del amor te espera con sus luces y su encanto.</p>
                </div>
                <div class="destination">
                    <img src="imagenes/newyork.jpg" alt="New York">
                    <h3>New York</h3>
                    <p>La ciudad que nunca duerme, llena de oportunidades y aventuras.</p>
                </div>
                <div class="destination">
                    <img src="imagenes/tokyo.jpg" alt="Tokyo">
                    <h3>Tokio</h3>
                    <p>Modernidad y tradición en una de las metrópolis más fascinantes.</p>
                </div>
            </div>
        </section>

        <!-- Beneficios -->
        <section class="benefits">
            <h2>¿Por qué elegirnos?</h2>
            <ul>
                <li>✈️ Más de 100 destinos internacionales</li>
                <li>💸 Ofertas exclusivas para miembros registrados</li>
                <li>🕑 Atención al cliente 24/7</li>
            </ul>
        </section>
        <?php endif; ?>
    </main>

    <!-- 🔹 Modal para Planificar Viaje -->
    <div id="tripModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2 id="modal-title">Planifica tu viaje</h2>
            <form action="save_trip.php" method="POST">
                <input type="hidden" name="destination" id="modal-destination">

                <label>Motivo del viaje:</label>
                <select name="motivo" required>
                    <option value="Vacaciones">Vacaciones</option>
                    <option value="Negocios">Negocios</option>
                    <option value="Estudios">Estudios</option>
                    <option value="Visita Familiar">Visita Familiar</option>
                    <option value="Salud">Salud</option>
                    <option value="Otro">Otro</option>
                </select>

                <label>Fecha de ida:</label>
                <input type="date" name="fecha_ida" required>

                <label>Fecha de vuelta:</label>
                <input type="date" name="fecha_vuelta" required>

                <label>Número de personas:</label>
                <input type="number" name="personas" min="1" required>

                <label>Presupuesto aproximado (USD):</label>
                <input type="number" name="presupuesto" step="0.01" required>

                <label>Preguntas o comentarios:</label>
                <textarea name="preguntas"></textarea>

                <button type="submit">Enviar Solicitud</button>
            </form>
        </div>
    </div>
    <!-- 🔹 Fin del Modal -->

    <!-- Footer -->
    <footer align="center">
        <p>Hecho por: <strong><a href="https://www.instagram.com/adri.planetas?igsh=MW1paXkyMXNkZnc1NA=="
                    target="_blank">Adrián</a>, y Rafael</strong></p>
    </footer>

    <!-- JS -->
    <script src="script.js"></script>
</body>

</html>