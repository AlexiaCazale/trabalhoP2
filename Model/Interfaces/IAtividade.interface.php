<?php

interface IAtividade
{
    public function getAtividades(): array;
    public function setAtividades(Atividade $atividade): void;
}

?>