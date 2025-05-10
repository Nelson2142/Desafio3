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

try {
    // Verificar si el email ya existe
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$data['email']]);
    
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'El email ya está registrado']);
        exit;
    }

    // Insertar nuevo usuario
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre_completo, email, password, fecha_nacimiento) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $data['nombre_completo'],
        $data['email'],
        $hashedPassword,
        $data['fecha_nacimiento']
    ]);

    echo json_encode(['success' => true, 'message' => 'Usuario registrado con éxito']);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error en el servidor: ' . $e->getMessage()]);
}
?>