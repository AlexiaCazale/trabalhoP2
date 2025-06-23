<?php
class a extends Componente
{
	public function __construct(
		private string $rota,
		private string $texto,
		protected ?string $class = null,
		protected ?string $style = null
	) {
	}

	public function criar()
	{
		echo "<a {$this->classString()} {$this->styleString()} href='{$this->rota}'>$this->texto</a>";
	}

}
?>