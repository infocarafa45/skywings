<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "<div class='success-msg'>✅ Registro exitoso. <a href='login.php'>Iniciar Sesión</a></div>";
    } else {
        echo "<div class='error-msg'>❌ Error: " . $stmt->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro - SkyWings Travel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="form-container">
        <h2>🛫 Crear Cuenta</h2>
        <p>Únete a <strong>SkyWings Travel</strong> y empieza tu aventura al mejor precio.</p>

        <form method="post" class="register-form">
            <input type="text" name="name" placeholder="✍️ Tu nombre completo" required>
            <input type="email" name="email" placeholder="📧 Tu correo electrónico" required>
            <input type="password" name="password" placeholder="🔑 Crea una contraseña" required>
            <button type="submit">Registrarse</button>
        </form>

        <p class="redirect-text">¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>

        <!-- Botón para ir al inicio -->
        <a href="index.php" class="back-btn">⬅️ Volver a la página principal</a>
    </div>
</body>

</html>