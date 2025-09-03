<?php
session_start();
include "db.php";

$error = ""; // Variable para guardar el mensaje de error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Preparar la consulta
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $name, $hashed_password);

    if ($stmt->fetch()) {
        // Usuario encontrado, verificar contraseña
        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["user_name"] = $name;
            header("Location: index.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "El correo no está registrado.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <style>
    head {background-color: blue;}
</style>
    <title>Iniciar Sesión - SkyWings</title>
</head>

<body>
    <style>
        body {background-color: antiquewhite;}
    </style>
    <h2>Iniciar Sesión</h2>

    <?php if ($error): ?>
    <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Contraseña" required><br><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>

</html>