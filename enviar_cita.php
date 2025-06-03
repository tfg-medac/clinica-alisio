<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Recoge datos del formulario
$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$fecha = $_POST['fecha'] ?? '';
$mensaje = $_POST['mensaje'] ?? '';

// Configura PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP de Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'clinica4afisio@gmail.com';       // Tu correo Gmail
    $mail->Password = 'xuhasofukqrdqbha';               // Contraseña de aplicación (no tu clave normal)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Remitente y destinatario
    $mail->setFrom($correo, $nombre);
    $mail->addAddress('clinica4afisio@gmail.com', 'Clínica Afisio');

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Solicitud de Cita Online';
    $mail->Body = "
        <h3>Nueva solicitud de cita online</h3>
        <p><strong>Nombre:</strong> $nombre</p>
        <p><strong>Correo:</strong> $correo</p>
        <p><strong>Teléfono:</strong> $telefono</p>
        <p><strong>Fecha deseada:</strong> $fecha</p>
        <p><strong>Mensaje adicional:</strong> $mensaje</p>
    ";

    $mail->send();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
}
