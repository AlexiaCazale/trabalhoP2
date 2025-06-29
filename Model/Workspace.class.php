<?php
class Workspace implements IAtividade, IUsuario
{
	use TemUsuario, TemAtividade;

	public function __construct(
		private ?int $id = 0,
		private ?string $nome = "",
		private ?string $descricao = "",
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
	public function getDescricao()
	{
		return $this->descricao;
	}
	public function setDescricao(string $descricao)
	{
		$this->descricao = $descricao;
	}
	public function getAtivo()
	{
		return $this->ativo;
	}
	public function setAtivo(bool $ativo)
	{
		$this->ativo = $ativo;
	}
}

?>