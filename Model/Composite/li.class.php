<?php
class li extends Componente
{
	public function __construct(
		private $elemento,
		protected ?string $class = null,
		protected ?string $style = null
	) {
	}

	public function criar()
	{
		echo "<li {$this->classString()} {$this->styleString()}>";
		$this->elemento->criar();
		echo "</li>";
	}
}
?>