# Inventario - Perfil System (Full)

Estructura mínima para integrar en tu proyecto (coloca `public/` como webroot).

## Requisitos
- PHP 7.4+ con PDO MySQL
- MySQL / MariaDB
- Composer (opcional, para PHPMailer)
- Configurar `config/Conexion.php` con tus credenciales DB
- Configurar `config/mail.php` con SMTP real si quieres envío por PHPMailer

## Instalación rápida
1. Importa `database/schema.sql` en tu servidor MySQL.
2. Reemplaza `REPLACE_WITH_HASH` en la inserción demo por:
   - Ejecuta en PHP: `echo password_hash('secret123', PASSWORD_DEFAULT);` y pega el valor.
3. Ajusta `config/Conexion.php` y `config/mail.php`.
4. Coloca la carpeta `public/` como DocumentRoot.
5. (Opcional) Instala PHPMailer: `composer require phpmailer/phpmailer`

## Rutas importantes (ejemplo)
- `/` o `/dashboard` - Dashboard
- `/profile` - Ver y editar perfil
- `/profile/update` - POST guardar perfil
- `/profile/password` - POST cambiar contraseña (requiere actual)
- `/profile/permisos` - POST actualizar permisos
- `/recuperar` - GET/POST iniciar recuperación
- `/recuperar/validar` - GET/POST validar código o keyword
- `/recuperar/nueva` - GET formulario nueva contraseña
- `/recuperar/nueva_accion` - POST actualizar contraseña
- `/api/chatbot` - POST JSON `{ "msg": "..." }` para chat demo

## Notas de seguridad
- Usa HTTPS en producción.
- Valida/escapa datos y controla tamaños de archivos.
- Configura límites y verificación MIME para archivos subidos.

