document.addEventListener('DOMContentLoaded', function() {
    const noticiaModal = new bootstrap.Modal(document.getElementById('noticiaModal'));
    const modalContent = document.querySelector('#noticiaModal .modal-content');

    // Función para mostrar el loading
    function showLoading() {
        modalContent.innerHTML = `
            <div class="modal-body text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
                <p class="mt-2">Cargando noticia...</p>
            </div>
        `;
    }

    // Manejador de clics en los botones de ver noticia
    document.querySelectorAll('[data-noticia-id]').forEach(button => {
        button.addEventListener('click', function() {
            const noticiaId = this.dataset.noticiaId;
            
            // Mostrar modal con loading
            showLoading();
            noticiaModal.show();

            // Cargar contenido
            fetch(`/noticias/${noticiaId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(html => {
                modalContent.innerHTML = html;
            })
            .catch(error => {
                modalContent.innerHTML = `
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            Error al cargar la noticia. Por favor, intente nuevamente.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                `;
            });
        });
    });
});
