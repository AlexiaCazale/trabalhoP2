<?php

class Atividade implements IUsuario
{
	use TemUsuario;

	public function __construct(
		private ?int $id = 0,
		private ?string $nome = "",
		private ?DateTime $dataEntrega,
		private ?DateTime $dataCriacao,
		private ?string $descricao = "",
		private ?Workspace $workspace = null,
		private ?array $comentarios = null,
		private ?bool $ativo = true
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
}

?>