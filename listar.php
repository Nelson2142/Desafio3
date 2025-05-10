<?php
header('Content-Type: application/json');
require 'db.php';

try {
    $stmt = $conn->query("SELECT id, nombre_completo, email, fecha_nacimiento, fecha_registro FROM usuarios ORDER BY fecha_registro DESC");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode(['success' => true, 'usuarios' => $usuarios]);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error al obtener usuarios: ' . $e->getMessage()]);
}
?>