<?php
session_start();
include "db.php";

$error = ""; // Mensaje de error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $name, $hashed_password);

    if ($stmt->fetch()) {
        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["user_name"] = $name;
            header("Location: index.php");
            exit;
        } else {
            $error = "❌ Contraseña incorrecta.";
        }
    } else {
        $error = "❌ El correo no está registrado.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - SkyWings Travel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="form-container">
        <h2>🔑 Iniciar Sesión</h2>
        <p>Accede a tu cuenta y comienza a explorar los mejores destinos.</p>

        <?php if ($error): ?>
        <p class="error-msg"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="post" class="login-form">
            <input type="email" name="email" placeholder="📧 Tu correo" required>
            <input type="password" name="password" placeholder="🔒 Tu contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>

        <p class="redirect-text">¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>

        <!-- Botón para volver a la página principal -->
        <a href="index.php" class="back-btn">⬅️ Volver a la página principal</a>
    </div>
</body>

</html>