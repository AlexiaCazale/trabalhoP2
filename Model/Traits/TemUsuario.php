<?php

trait TemUsuario
{
	private array $usuarios = [];

	public function getUsuarios(): array
	{
		return $this->usuarios;
	}

	public function setUsuarios(Usuario $usuario): void
	{
		$this->usuarios[] = $usuario;
	}
}

?>