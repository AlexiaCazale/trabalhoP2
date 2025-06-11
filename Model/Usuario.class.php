<?php
class Usuario implements AtividadeContract
{
    use TemAtividade;

    public function __construct(
        private int $idUsuario = 0,
        private string $nome = "",
        private string $email = "",
        private string $senha = "",
        private array $workspaces = []
    ) {
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    public function setIdUsuario(int $id)
    {
        $this->idUsuario = $id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function getSenha()
    {
        return $this->senha;
    }
    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }
    public function getWorkspaces()
    {
        return $this->workspaces;
    }
    public function setWorkspaces(Workspace $workspace)
    {
        $this->workspaces[] = $workspace;
    }
}

?>