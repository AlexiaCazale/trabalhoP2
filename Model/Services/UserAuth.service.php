<?php

class UserAuth {
    public static function userIsLogged() {
        if (isset($_SESSION['usuario_id'])) {
            return True;
        } else {
            header("Location: /trabalhoP2/form_login");
            exit();
        }
    }
}

?>