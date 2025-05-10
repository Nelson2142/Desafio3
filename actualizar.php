<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

// Validación
if (empty($data['id']) || empty($data['nombre_completo']) || empty($data['email']) || empty($data['fecha_nacimiento'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success'=>false,'message'=>'Email no válido']);
    exit;
}

$fActual = new DateTime();
$fn  = DateTime::createFromFormat('Y-m-d',$data['fecha_nacimiento']);
if (!$fn || $fn > $fActual) {
    echo json_encode(['success'=>false,'message'=>'Fecha de nacimiento inválida']);
    exit;
}

try {
    // Verificar si el email ya existe en otro usuario
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
    $stmt->execute([$data['email'], $data['id']]);
    
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'El email ya está registrado en otro usuario']);
        exit;
    }

    // Actualizar usuario
    $stmt = $conn->prepare("UPDATE usuarios SET nombre_completo = ?, email = ?, fecha_nacimiento = ? WHERE id = ?");
    $stmt->execute([
        $data['nombre_completo'],
        $data['email'],
        $data['fecha_nacimiento'],
        $data['id']
    ]);

    echo json_encode(['success' => true, 'message' => 'Usuario actualizado con éxito']);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar usuario: ' . $e->getMessage()]);
}
?>