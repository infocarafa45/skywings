<?php
session_start();
include "db.php";

// Importar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (!isset($_SESSION["user_id"])) {
    die("Debes iniciar sesión para planificar un viaje.");
}

$user_id = $_SESSION["user_id"];
$destination = $_POST["destination"];
$motivo = $_POST["motivo"];
$fecha_ida = $_POST["fecha_ida"];
$fecha_vuelta = $_POST["fecha_vuelta"];
$personas = $_POST["personas"];
$presupuesto = $_POST["presupuesto"];
$preguntas = $_POST["preguntas"];

// Guardar en base de datos
$stmt = $conn->prepare("INSERT INTO trip_requests (user_id, destination, motivo, fecha_ida, fecha_vuelta, personas, presupuesto, preguntas) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssids", $user_id, $destination, $motivo, $fecha_ida, $fecha_vuelta, $personas, $presupuesto, $preguntas);

if ($stmt->execute()) {

    // Obtener email del usuario
    $sql = "SELECT email, name FROM users WHERE id = ?";
    $q = $conn->prepare($sql);
    $q->bind_param("i", $user_id);
    $q->execute();
    $q->bind_result($email, $name);
    $q->fetch();
    $q->close();

    // Configurar PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Servidor SMTP
    

        // Destinatarios
        $mail->setFrom('no-reply@skywings.com', 'SkyWings Travel');
        $mail->addAddress($email, $name);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = "Solicitud de viaje a $destination recibida";
        $mail->Body    = "Hola $name,<br><br>
                          Hemos recibido tu solicitud para viajar a <strong>$destination</strong>.<br>
                          Nuestro equipo la revisará y te contactará pronto.<br><br>
                          ¡Gracias por confiar en SkyWings Travel!";

        $mail->send();
        echo "<script>alert('Tu solicitud ha sido enviada correctamente. Revisa tu correo.'); window.location='index.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Tu solicitud fue guardada, pero no se pudo enviar el correo. Error: {$mail->ErrorInfo}'); window.location='index.php';</script>";
    }
} else {
    echo "Error al guardar la solicitud: " . $stmt->error;
}
