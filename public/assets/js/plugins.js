// Function to load script dynamically
function loadScript(src) {
    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = src;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });
}

// Check if we need to load any additional scripts
if (document.querySelectorAll("[toast-list]") || 
    document.querySelectorAll("[data-choices]") || 
    document.querySelectorAll("[data-provider]")) {
    
    // Load scripts in sequence
    Promise.all([
        loadScript('/assets/libs/choices.js/public/assets/scripts/choices.min.js'),
        loadScript('/assets/libs/flatpickr/flatpickr.min.js')
    ]).catch(console.error);
}