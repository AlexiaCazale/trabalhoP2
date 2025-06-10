<?php
class Atividade
{
    public function __construct(
        private int $idAtividade = 0,
        private string $nome = "",
        private DateTime $dataEntrega,
        private DateTime $dataCriacao,
        private string $descricao = "",
        private array $usuarios = [],
        private Workspace $workspace,
        private array $comentarios
    ) {
    }

    public function getIdAtividade()
    {
        return $this->idAtividade;
    }
    public function setIdAtividade(int $id)
    {
        $this->idAtividade = $id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }
    public function getDataEntrega()
    {
        return $this->dataEntrega;
    }
    public function setDataEntrega(DateTime $data)
    {
        $this->dataEntrega = $data;
    }
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }
    public function setDataCriacao(DateTime $data)
    {
        $this->dataCriacao = $data;
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
    public function getWorkspaces()
    {
        return $this->workspace;
    }
    public function setWorkspaces(Workspace $workspace)
    {
        $this->workspace = $workspace;
    }
    public function getComentarios()
    {
        return $this->comentarios;
    }
    public function setComentarios(Comentario $comentario)
    {
        $this->comentarios[] = $comentario;
    }
}

?>