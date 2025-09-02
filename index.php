<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SkyWings Travel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>🌍 SkyWings Travel</h1>
        <p>Encuentra las mejores tarifas para viajar!</p>
    </header>

    <nav>
        <?php if (isset($_SESSION["user_id"])): ?>
        <p>Welcome, <?php echo $_SESSION["user_name"]; ?> | <a href="logout.php">Logout</a></p>
        <?php else: ?>
        <p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
        <?php endif; ?>
    </nav>

    <main>
        <section id="flights">
            <h2 align="center">Vuelos Disponibles</h2>

            <?php if (isset($_SESSION["user_id"])): ?>
            <div class="flight-list">
                <?php
                    $sql = "SELECT origin, destination, date, price, image_url FROM flights ORDER BY date ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($flight = $result->fetch_assoc()) {
                            echo "<div class='flight'>";
                            echo "<img src='" . htmlspecialchars($flight['image_url']) . "' alt='Destination image' class='flight-img'>";
                            echo "<div class='flight-info'>";
                            echo "<p><strong>Desde:</strong> " . htmlspecialchars($flight['origin']) . " &nbsp;&nbsp;";
                            echo "<strong>Hasta:</strong> " . htmlspecialchars($flight['destination']) . "</p>";
                            echo "<p><strong>Fecha:</strong> " . htmlspecialchars($flight['date']) . "</p>";
                            echo "<p><strong>Precio:</strong> $" . htmlspecialchars($flight['price']) . "</p>";
                            echo "<button onclick=\"reserveFlight('{$flight['origin']}', '{$flight['destination']}', '{$flight['date']}')\">Reservar Vuelo</button>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No flights available right now.</p>";
                    }

                    $conn->close();
                    ?>
            </div>
            <?php else: ?>
            <p>You must <a href="login.php">log in</a> or <a href="register.php">register</a> to see available flights.
            </p>
            <?php endif; ?>
        </section>
    </main>

    <script>
    function reserveFlight(origin, destination, date) {
        alert("You selected a flight from " + origin + " to " + destination + " on " + date);
        // Aquí podrías hacer una redirección o enviar datos para reservar
    }
    </script>
</body>

</html>