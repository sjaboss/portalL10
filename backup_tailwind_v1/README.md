# Backup Tailwind v1

Este backup contiene la primera versión funcional de la integración de Tailwind CSS con Bootstrap en el proyecto.

Archivos incluidos:
1. `welcome.blade.php` - Plantilla principal con la tarjeta de ejemplo
2. `app.css` - Configuración de Tailwind y clases personalizadas
3. `tailwind.config.js` - Configuración de Tailwind con paleta de colores personalizada

## Características incluidas
- Integración exitosa de Tailwind CSS con Bootstrap
- Paleta de colores personalizada
- Sistema de aislamiento de estilos usando clases `bootstrap-only` y `tailwind-component`
- Ejemplo de tarjeta moderna con gradientes y efectos hover

## Cómo restaurar
Para volver a esta versión, simplemente copia los archivos de esta carpeta a sus ubicaciones originales:
- `welcome.blade.php` → `resources/views/welcome.blade.php`
- `app.css` → `resources/css/app.css`
- `tailwind.config.js` → `tailwind.config.js`

Después de restaurar, ejecuta:
```bash
npm run build
```
