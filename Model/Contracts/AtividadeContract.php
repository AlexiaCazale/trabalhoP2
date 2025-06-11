<?php

interface AtividadeContract
{
    public function getAtividades(): array;
    public function setAtividades(Atividade $atividade): void;
}