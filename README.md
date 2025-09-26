# ✈️ SkyWings Travel

Aplicación web desarrollada en **PHP 8.2.12, MySQL 8.4, HTML5, CSS3 y JavaScript ES6** para la gestión de vuelos y planificación de viajes.  
Los usuarios pueden registrarse, iniciar sesión, consultar vuelos disponibles y enviar solicitudes de planificación de viaje que se guardan en la base de datos y generan notificaciones por correo.

---

## 🚀 Características principales

- Registro e inicio de sesión de usuarios.
- Visualización de vuelos disponibles (solo para usuarios logueados).
- Página principal que muestra destinos populares y beneficios.
- Sistema de planificación de viajes mediante un formulario modal:
  - Motivo del viaje (selector con varias opciones).
  - Fecha de ida y vuelta.
  - Número de personas.
  - Presupuesto.
  - Campo de preguntas adicionales.
- Al enviar el formulario:
  - Se guarda la solicitud en la base de datos.
  - Se envía un correo de confirmación al usuario (usando **PHPMailer**).

---

## 📂 Estructura del proyecto

```
skywings/
    ├── index.php # Página principal
    ├── login.php # Inicio de sesión
    ├── register.php # Registro de usuarios
    ├── logout.php # Cerrar sesión
    ├── save_trip.php # Procesar formulario de planificación de viaje
    ├── db.php # Conexión a la base de datos
    ├── style.css # Estilos de la aplicación
    ├── script.js # Funciones JS (modal, buscador dinámico, etc.)
    ├── /imagenes # Carpeta de imágenes (favicon, destinos, vuelos)
    └── /vendor # Dependencias instaladas con Composer (PHPMailer)
```

---

## 🛠️ Requisitos

- **XAMPP** (o cualquier servidor con Apache, PHP y MySQL).
- **PHP 8+** (probado con PHP 8.2).
- **MySQL / MariaDB** para la base de datos.
- **Composer** (para instalar PHPMailer).
- Navegador moderno (Chrome, Firefox, Edge).

---

## ⚙️ Instalación en local

1. Clonar el repositorio o copiar los archivos al directorio `htdocs` de XAMPP.
2. Crear la base de datos en phpMyAdmin:
   - Nombre recomendado: `skywings`.
   - Importar el archivo `skywings.sql` incluido en `/database` (si existe).
3. Configurar la conexión en `db.php`:

   ```php
   <?php
   $servername = "localhost";
   $username   = "root";
   $password   = "";
   $dbname     = "skywings";

   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   $conn->set_charset("utf8mb4");
   ```

4. Instalar dependencias con Composer:
   ```bash
   composer require phpmailer/phpmailer
   ```
