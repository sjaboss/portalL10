<div class="modal-body">
    <form id="contactForm" method="POST" action="{{ route('contact.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
            <div class="invalid-feedback" id="nameError"></div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback" id="emailError"></div>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono (opcional)</label>
            <input type="text" class="form-control" id="phone" name="phone">
            <div class="invalid-feedback" id="phoneError"></div>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Mensaje</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            <div class="invalid-feedback" id="messageError"></div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
        </div>
    </form>
</div>
