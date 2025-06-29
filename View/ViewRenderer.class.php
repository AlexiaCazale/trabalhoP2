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

        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>';

        echo '<script src="View/Scripts/tooltipOnImg.js"></script>';

        echo "</body>";

        echo "</html>";
    }
}

?>