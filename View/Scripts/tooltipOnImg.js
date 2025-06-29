document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        // Define o container da tooltip para 'body'
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            container: 'body'
        });
    })
});