<?php
class Workspace implements AtividadeContract, UsuarioContract 
{
    use TemUsuario, TemAtividade;

    public function __construct(
        private int $idWorkspace = 0,
        private string $nome = "",
        private string $descricao = ""
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
}

?>