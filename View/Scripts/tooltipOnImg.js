console.log("Tooltip initialization script started.");
if (typeof bootstrap !== "undefined" && typeof bootstrap.Tooltip !== "undefined") {
    console.log("Bootstrap Tooltip class is available.");
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    console.log("Found tooltip triggers:", tooltipTriggerList.length, tooltipTriggerList);

    // Determine the offset based on the PHP view name
    let tooltipOffset = [0, 0]; // Default offset
    let pageUrlSplitted = document.URL.split("/")
    let pagePath = pageUrlSplitted[pageUrlSplitted.length - 1]

    if (pagePath === "") {
        tooltipOffset = [0, 0]; // Offset for home.php
        console.log("Setting offset for home.php:", tooltipOffset);
    } else if (pagePath.includes("workspace")) {
        tooltipOffset = [0, -68]; // Offset for workspace.php
        console.log("Setting offset for workspace.php:", tooltipOffset);
    } else {
        console.log("No specific offset defined for this page:", document.URL.split("/")[-1]);
    }

    if (tooltipTriggerList.length > 0) {
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            console.log("Initializing tooltip for:", tooltipTriggerEl);
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                offset: tooltipOffset // Apply the determined offset
            });
        });
        console.log("Tooltips initialized:", tooltipList.length);
    } else {
        console.log("No elements with data-bs-toggle=\"tooltip\" found.");
    }
} else {
    console.log("Bootstrap Tooltip class is NOT available. Check Bootstrap JS loading.");
}