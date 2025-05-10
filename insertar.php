<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

// Validación del lado del servidor
if (empty($data['nombre_completo']) || empty($data['email']) || empty($data['password']) || empty($data['fecha_nacimiento'])) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son requeridos']);
    exit;
}

if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Email no válido']);
    exit;
}

// Validación de fecha de nacimiento
$fActual = new DateTime();
$fn = DateTime::createFromFormat('Y-m-d', $data['fecha_nacimiento']);
if (!$fn || $fn > $fActual) {
    echo json_encode(['success' => false, 'message' => 'Fecha de nacimiento inválida']);
    exit;
}

// Validar que el usuario sea mayor de 18 años
$edad = $fActual->diff($fn)->y; // Calcular la edad en años
if ($edad < 18) {
    echo json_encode(['success' => false, 'message' => 'Debes tener al menos 18 años para registrarte']);
    exit;
}

$nombre = htmlspecialchars($data['nombre_completo']);
$email  = htmlspecialchars($data['email']);

try {
    // Verificar si el email ya existe
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'El email ya está registrado']);
        exit;
    }

    // Insertar nuevo usuario
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare(
        "INSERT INTO usuarios 
         (nombre_completo, email, password, fecha_nacimiento) 
         VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$nombre, $email, $hashedPassword, $data['fecha_nacimiento']]);

    echo json_encode(['success' => true, 'message' => 'Usuario registrado con éxito']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error en el servidor: ' . $e->getMessage()]);
}
?>
