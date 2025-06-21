## 🐳 Cómo correr el proyecto con Docker

### 1. Clonar el proyecto

```bash
git clone https://github.com/tuusuario/ticket-system.git
cd ticket-system
Datos .ENV
DB_HOST=db
DB_USERNAME=root
DB_PASSWORD=
DB_DATABASE=test-tickets

Instalar dependencias
docker exec -it nombre_del_contenedor_app bash

composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link

Abrí en el navegador en la url y puerto que le asignamos
http://localhost:8000
Si lo usamos local en nuestra carpeta de XAMP,WAMP,etc
Clonar el proyector e instalar las dependencias.

🧑💻 Usuarios por defecto (Seed)
•	Admin
Email: admin@example.com
Password: password
•	Agente
Email: agente@example.com
Password: password
•	Usuario
Email: user@example.com
Password: password
📝 Funcionalidades
•	Login con control de roles
•	CRUD de Tickets
•	Notificaciones para usuarios y agentes
•	Subida de documentos
•	Control de estado
•	Listado general de notificaciones
________________________________________
📦 Stack
•	Laravel 8
•	PHP 7.4
•	MySQL 5.7
•	Docker
•	Bootstrap 5 + Blade


