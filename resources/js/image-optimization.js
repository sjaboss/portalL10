// Función para crear versiones optimizadas de imágenes
function createOptimizedImage(img) {
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    
    // Establecer dimensiones máximas
    const maxWidth = 800;
    const maxHeight = 600;
    
    let width = img.width;
    let height = img.height;
    
    // Calcular nuevas dimensiones manteniendo la proporción
    if (width > height) {
        if (width > maxWidth) {
            height *= maxWidth / width;
            width = maxWidth;
        }
    } else {
        if (height > maxHeight) {
            width *= maxHeight / height;
            height = maxHeight;
        }
    }
    
    // Establecer dimensiones del canvas
    canvas.width = width;
    canvas.height = height;
    
    // Dibujar imagen redimensionada
    ctx.drawImage(img, 0, 0, width, height);
    
    // Retornar URL de la imagen optimizada
    return canvas.toDataURL('image/jpeg', 0.8);
}

// Función para optimizar imágenes al cargar
function optimizeImages() {
    const images = document.querySelectorAll('img[data-optimize]');
    
    images.forEach(img => {
        if (img.complete) {
            const optimizedSrc = createOptimizedImage(img);
            img.src = optimizedSrc;
            img.removeAttribute('data-optimize');
        } else {
            img.onload = function() {
                const optimizedSrc = createOptimizedImage(img);
                img.src = optimizedSrc;
                img.removeAttribute('data-optimize');
            };
        }
    });
}

// Ejecutar optimización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', optimizeImages);

// Exportar funciones para uso en otros archivos
export { createOptimizedImage, optimizeImages };
