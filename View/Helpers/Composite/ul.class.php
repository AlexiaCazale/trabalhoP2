<?php
class ul extends Componente
{
	public function __construct(
		private array $elementos = array(),
		protected ?string $tagId = null,
		protected ?string $class = null,
		protected ?string $style = null
	) {
	}

	public function criar()
	{
		echo "<ul {$this->classTagId()} {$this->classString()} {$this->styleString()}>";
		foreach ($this->elementos as $dado) {
			$dado->criar();
		}

		echo "</ul>";
	}
	public function setElemento($elemento)
	{
		$this->elementos[] = $elemento;
	}

}
?>