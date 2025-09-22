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
            <div class="flight-list">
                <?php
                    $sql = "SELECT origin, destination, date, price, image_url FROM flights ORDER BY date ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($flight = $result->fetch_assoc()) {
                            echo "<div class='flight'>";
                            echo "<img src='" . htmlspecialchars($flight['image_url']) . "' alt='Destino' class='flight-img'>";
                            echo "<div class='flight-info'>";
                            echo "<p><strong>Desde:</strong> " . htmlspecialchars($flight['origin']) . " &nbsp;&nbsp;";
                            echo "<strong>Hasta:</strong> " . htmlspecialchars($flight['destination']) . "</p>";
                            echo "<p><strong>Fecha:</strong> " . htmlspecialchars($flight['date']) . "</p>";
                            echo "<p><strong>Precio:</strong> $" . htmlspecialchars($flight['price']) . "</p>";
                            echo "<button onclick=\"reserveFlight('{$flight['origin']}', '{$flight['destination']}', '{$flight['date']}')\">Planificar Viaje</button>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No hay vuelos disponibles actualmente.</p>";
                    }

                    $conn->close();
                    ?>
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


    <!-- Footer -->
    <footer align="center">
        <p>Hecho por: <strong><a href="https://www.instagram.com/adri.planetas?igsh=MW1paXkyMXNkZnc1NA=="
                    target="_blank">Adrián</a>, y Rafael</strong></p>
    </footer>

    <!-- JS -->
    <script src="script.js"></script>
</body>

</html>