<?php
class Workspace
{
    public function __construct(
        private int $idWorkspace = 0,
        private string $nome = "",
        private string $descricao = "",
        private array $usuarios = [],
        private array $atividades = []
    ) {
    }

    public function getIdWorkspace()
    {
        return $this->idWorkspace;
    }
    public function setIdWorkspace(int $id) 
    {
        $this->idWorkspace = $id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome(string $nome) 
    {
        $this->nome = $nome;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }
    public function getUsuarios()
    {
        return $this->usuarios;
    }
    public function setUsuarios(Usuario $usuario)
    {
        $this->usuarios[] = $usuario;
    }
    public function getAtividades()
    {
        return $this->atividades;
    }
    public function setAtividades(Atividade $atividade)
    {
        $this->atividades[] = $atividade;
    }
}

?>