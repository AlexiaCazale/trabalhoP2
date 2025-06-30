<?php

class ViewRenderer
{
    public static function render(string $viewName, array $context = [])
    {
        echo "<html>";

        require_once "View/Component/head.php";

        echo "<body>";

        extract($context);

        require_once "View/Component/header.php"; // Header component
        require_once "View/{$viewName}.php";

        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>';

        echo '<script src="View/Scripts/tooltipOnImg.js"></script>';

        echo "</body>";

        echo "</html>";
    }

    public static function renderErrorPage(string $errorCode, string $errorTitle, string $errorDescription) 
    {
        self::render("error_view", [
            "errorCode" => $errorCode,
            "errorTitle" => $errorTitle,
            "errorDescription" => $errorDescription
        ]);
    }
}

?>