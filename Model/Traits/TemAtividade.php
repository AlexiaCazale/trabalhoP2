<?php

trait TemAtividade
{
    private array $atividades = [];

    public function getAtividades(): array
    {
        return $this->atividades;
    }

    public function setAtividades(Atividade $atividade): void
    {
        $this->atividades[] = $atividade;
    }
}