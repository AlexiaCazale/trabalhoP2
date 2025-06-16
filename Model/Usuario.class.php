<?php
class Usuario implements IAtividade
{
    use TemAtividade;

    public function __construct(
        private int $id = 0,
        private string $nome = "",
        private string $email = "",
        private string $senha = "",
        private string $avatar = "",
        private array $workspaces = []
    ) {
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = $id;
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
    public function getAvatar()
    {
        return $this->avatar;
    }
    public function setAvatar(string $avatar) 
    {
        $this->avatar = $avatar;
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