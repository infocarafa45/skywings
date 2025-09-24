<?php
include "db.php";

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : "";

$sql = "SELECT origin, destination, date, price, image_url FROM flights";
if ($search != "") {
    $sql .= " WHERE origin LIKE '%$search%' OR destination LIKE '%$search%'";
}
$sql .= " ORDER BY date ASC";

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
        echo "<button onclick=\"planFlight('{$flight['origin']}', '{$flight['destination']}', '{$flight['date']}')\">Planificar Viaje</button>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No se encontraron vuelos con esa búsqueda.</p>";
}