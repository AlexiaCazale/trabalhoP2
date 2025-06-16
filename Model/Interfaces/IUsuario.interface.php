<?php

interface IUsuario
{
    public function getUsuarios(): array;
    public function setUsuarios(Usuario $usuario): void;
}

?>