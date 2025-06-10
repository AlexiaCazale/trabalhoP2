<?php
class Atividade
{
    public function __construct(
        private int $idAtividade = 0,
        private string $nome = "",
        private DateTime $dataEntrega,
        private string $descricao = "",
        private array $usuarios = [],
        private Workspace $workspace
    ) {
    }

    // TODO: Adicionar membros -> não obrigatório?

    public function getIdAtividade()
    {
        return $this->idAtividade;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getDate()
    {
        return $this->dataEntrega;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
}

?>