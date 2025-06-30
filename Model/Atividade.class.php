<?php

class Atividade implements IUsuario
{
	use TemUsuario;

	public function __construct(
		private ?int $id = null,
		private ?string $nome = "",
		private DateTime|string $dataEntrega = "",
		private DateTime|string $dataCriacao = "",
		private ?string $descricao = "",
		private ?Workspace $workspace = null,
		private ?array $comentarios = [],
		private ?bool $ativo = true,
		private ?bool $concluido = false,
		private ?DateTime $dataConcluido = null
	) {
		// As chamadas no construtor já estavam corretas
        if (is_string($dataCriacao)) {
            $this->setDataCriacao($dataCriacao);
        }
        
        if (is_string($dataEntrega)) {
            $this->setDataEntrega($dataEntrega);
        }

        if (is_string($dataConcluido)) {
            $this->setDataConcluido($dataConcluido);
        }
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
	public function getDataEntrega()
	{
		return $this->dataEntrega;
	}
	 public function setDataEntrega(DateTime|string $data): void
    {
        if (is_string($data) && !empty($data)) {
            $this->dataEntrega = new DateTime($data);
        } elseif ($data instanceof DateTime) {
            $this->dataEntrega = $data;
        }
    }
	public function getDataCriacao()
	{
		return $this->dataCriacao;
	}
	public function setDataCriacao(DateTime|string $data): void
    {
        if (is_string($data) && !empty($data)) {
            $this->dataCriacao = new DateTime($data);
        } elseif ($data instanceof DateTime) {
            $this->dataCriacao = $data;
        }
    }
	public function getDescricao()
	{
		return $this->descricao;
	}
	public function setDescricao(string $descricao)
	{
		$this->descricao = $descricao;
	}
	public function getWorkspace()
	{
		return $this->workspace;
	}
	public function setWorkspace(Workspace $workspace)
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
	public function getAtivo()
	{
		return $this->ativo;
	}
	public function setAtivo(bool $ativo)
	{
		$this->ativo = $ativo;
	}
	public function getConcluido() 
	{
		return $this->concluido;
	}
	public function setConcluido(bool $concluido) 
	{
		$this->concluido = $concluido;
	}
	public function getDataConcluido() 
	{
		return $this->dataConcluido;
	}
	 public function setDataConcluido(DateTime|string|null $data): void
    {
        if (is_string($data) && !empty($data)) {
            $this->dataConcluido = new DateTime($data);
        } elseif ($data instanceof DateTime) {
            $this->dataConcluido = $data;
        } else {
            $this->dataConcluido = null;
        }
    }
}

?>