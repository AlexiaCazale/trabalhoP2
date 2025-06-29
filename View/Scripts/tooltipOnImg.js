console.log("Tooltip initialization script started.");
if (typeof bootstrap !== "undefined" && typeof bootstrap.Tooltip !== "undefined") {
    console.log("Bootstrap Tooltip class is available.");
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    console.log("Found tooltip triggers:", tooltipTriggerList.length, tooltipTriggerList);

    if (tooltipTriggerList.length > 0) {
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            console.log("Initializing tooltip for:", tooltipTriggerEl);
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                // Mantém um offset vertical consistente de 8px
                offset: [0, 8],
                container: tooltipTriggerEl.parentElement 
            });
        });
        console.log("Tooltips initialized:", tooltipList.length);
    } else {
        console.log("No elements with data-bs-toggle=\"tooltip\" found.");
    }
} else {
    console.log("Bootstrap Tooltip class is NOT available. Check Bootstrap JS loading.");
}