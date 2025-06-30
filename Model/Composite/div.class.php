<?php
class div extends Componente
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
		echo "<div {$this->classTagId()} {$this->classString()} {$this->styleString()}>";
		foreach ($this->elementos as $dado) {
			$dado->criar();
		}

		echo "</div>";
	}
	public function setElemento($elemento, bool $setInFirstIndex = false)
	{
		$this->elementos[] = $elemento;
	}

	public function reverseElementos()
	{
		if (count($this->elementos) > 1) 
		{
			$this->elementos = array_reverse($this->elementos);
		} 
	}

	public function getElemento()
	{
		return $this->elementos;
	}

}
?>