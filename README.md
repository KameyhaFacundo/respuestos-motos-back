# Backend - Sistema de Gestión de Repuestos de Motos

Backend desarrollado con Laravel 10 para el sistema de gestión de repuestos de motos.

## Requisitos

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js >= 16

## Instalación

1. Clonar el repositorio
2. Instalar dependencias de PHP:
```bash
composer install
```

3. Instalar dependencias de Node:
```bash
npm install
```

4. Copiar el archivo de configuración:
```bash
cp .env.example .env
```

5. Generar la clave de aplicación:
```bash
php artisan key:generate
```

6. Configurar la base de datos en el archivo `.env`

7. Ejecutar las migraciones:
```bash
php artisan migrate
```

8. Generar la clave JWT:
```bash
php artisan jwt:secret
```

## Desarrollo

Ejecutar el servidor de desarrollo:
```bash
php artisan serve
```

Compilar assets:
```bash
npm run dev
```

## Testing

Ejecutar tests:
```bash
php artisan test
```

## Licencia

Este proyecto es software privado.
# laravel-backend-template
