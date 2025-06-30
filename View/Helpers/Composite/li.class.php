<?php
class li extends Componente
{
	public function __construct(
		private $elemento,
		protected ?string $tagId = null,
		protected ?string $class = null,
		protected ?string $style = null
	) {
	}

	public function criar()
	{
		echo "<li {$this->classTagId()} {$this->classString()} {$this->styleString()}>";
		$this->elemento->criar();
		echo "</li>";
	}
}
?>