<?php

interface UsuarioContract
{
    public function getUsuarios(): array;
    public function setUsuarios(Usuario $usuario): void;
}