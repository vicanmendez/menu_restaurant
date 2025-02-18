<h1> Sistema de gestión de pedidos para restaurante </h1>
(ideal para generar QRs en cartas de menú)





Bienvenido/a a este proyecto Laravel. Es una pequeña contribución al rubro, desarrollada con gusto y en constante mejora. 🌱

📌 Características

✅ Laravel 10 y PHP 8.x
✅ Base de datos SQLite (en producción es ideal usar MariaDB u otro sistema similar)
✅ Autenticación de usuarios
✅ API RESTful (en desarrollo)
✅ Panel de administración (próximamente)

📥 Instalación Local

🔧 Requisitos Previos

PHP (>= 8.x)

Composer (https://getcomposer.org/)

MySQL o MariaDB (ideal, para trabajar en local se puede usar SQLite)

Node.js & npm (para assets frontend)

💻 Pasos para Ejecutar en Local

# 1️⃣ Clonar el repositorio
git clone https://github.com/vicanmendez/menu_restaurant.git
cd proyecto-laravel

# 2️⃣ Instalar dependencias 
composer install
npm install && npm run build

# 3️⃣ Configurar variables de entorno
cp .env.example .env
php artisan key:generate

# 4️⃣ Configurar base de datos
# Editar el archivo .env con las credenciales de MySQL
php artisan migrate

# 5️⃣ Levantar el servidor local
php artisan serve

# IPORTANTE: Inicialmente, tendrías que registrar un usuario al menos para la administración

La aplicación estará disponible en http://127.0.0.1:8000
Para crear un nuevo usuario: <b> http:127.0.0.1:8000/register </b>

🌍 Despliegue en Web Hosting Compartido

1️⃣ Subir archivos al hosting mediante FTP o Panel de Control (ej. cPanel).2️⃣ Configurar .env con las credenciales de la base de datos del servidor.3️⃣ Ejecutar migraciones en el servidor remoto:

php artisan migrate --force

4️⃣ Asegurar permisos para storage y bootstrap/cache:

chmod -R 775 storage bootstrap/cache

5️⃣ Apuntar el dominio/subdominio al directorio public/ del proyecto.

☁️ Despliegue en Cloud (Ejemplo: DigitalOcean, AWS, Heroku)

🔹 Opción 1: DigitalOcean / VPS

Configurar servidor con Ubuntu 22.04, Nginx, MySQL y PHP.

Subir archivos via Git o FTP.

Configurar Nginx para apuntar a public/.

Configurar HTTPS con Let's Encrypt.

Ejecutar migraciones y permisos (php artisan migrate --force).

🔹 Opción 2: Heroku

heroku create proyecto-laravel
heroku addons:add heroku-mysql
heroku config:set APP_KEY=$(php artisan key:generate --show)
git push heroku main

⚖️ Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo LICENSE para más detalles.

📬 Contacto - Víctor Méndez

📧 Email: info@queenbeesoftware.com 🌍 Web: www.queenbeesoftware.com🐙 GitHub: github.com/vicanmendez
