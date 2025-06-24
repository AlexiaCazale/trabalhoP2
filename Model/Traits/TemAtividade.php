<?php

trait TemAtividade
{
	/**
	 * Traço que implementa um array de atividades e seus métodos para acesso e alteração
	 * 
	 * @param $atividades array com todas as atividades
	 * 
	 * @method array getAtividades() retorna as atividades dentro do objeto
	 * @method void setAtividades() adiciona uma nova atividade às atividades 
	 */

	private array $atividades = [];

	public function getAtividades(): array
	{
		return $this->atividades;
	}

	public function setAtividades(Atividade $atividade): void
	{
		$this->atividades[] = $atividade;
	}
}

?>