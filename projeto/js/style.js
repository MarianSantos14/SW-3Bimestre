
(() => {
    'use strict';

    const forms = document.querySelectorAll('form.needs-validation');

    forms.forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            // Ativa os estilos de validação do Bootstrap
            form.classList.add('was-validated');
        });
    });
})();