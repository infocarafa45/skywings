<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='login.php'>Iniciar Sesion</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<h2>Registro</h2>
<form method="post">
    <input type="text" name="name" placeholder="Escribe tu nombre" required><br><br>
    <input type="email" name="email" placeholder="Escribe tu correo" required><br><br>
    <input type="password" name="password" placeholder="Escribe una constraseña" required><br><br>
    <button type="submit">Registrarse</button>
</form>