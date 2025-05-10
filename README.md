# 📚 Desafío 3 - Sistema de Registro de Usuarios en PHP

Este proyecto es un sistema web básico para registrar, listar y gestionar usuarios. Utiliza PHP puro y una base de datos MySQL. La información se almacena en la tabla `usuarios`.


---

## 🧰 Requisitos del sistema

- PHP 7.4 o superior  
- MySQL / MariaDB  
- Servidor local (XAMPP, WAMP, MAMP, Laragon o similar)  
- Navegador web

---

## ⚙️ Instalación y configuración

### Sentencia SQL para crear base de datos necesaria para poder correr el ejercicio

-CREATE DATABASE IF NOT EXISTS sistema_usuarios;
USE sistema_usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
---

### 1. Clonar el repositorio

```bash
git clone https://github.com/Nelson2142/Desafio3.git




