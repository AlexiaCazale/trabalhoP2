<?php
class Comentario
{

	// Não utiliza o traço TemUsuario por sempre conter apenas 1 usuário

	public function __construct(
		private ?int $id = 0,
		private ?string $texto = "",
		private ?Usuario $usuario
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
	public function getTexto()
	{
		return $this->texto;
	}
	public function setTexto(string $texto)
	{
		$this->texto = $texto;
	}
	public function getUsuario()
	{
		return $this->usuario;
	}
	public function setUsuario(Usuario $usuario)
	{
		$this->usuario = $usuario;
	}
}
?>