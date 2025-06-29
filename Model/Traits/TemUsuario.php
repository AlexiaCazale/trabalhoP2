<?php

trait TemUsuario
{
	/**
	 * Traço que implementa um array de usuários e seus métodos para acesso e alteração
	 * 
	 * @param $usuarios array com todos os usuários
	 * 
	 * @method array getUsuarios() retorna os usuários dentro do objeto
	 * @method void setUsuarios() adiciona um novo usuário ao objeto 
	 */

	private array $usuarios = [];

	public function getUsuarios(): array
	{
		return $this->usuarios;
	}

	public function setUsuarios(Usuario $usuario): void
	{
		$this->usuarios[] = $usuario;
	}

	  public function limparUsuarios(): void {
        $this->usuarios = [];
    }
}

?>