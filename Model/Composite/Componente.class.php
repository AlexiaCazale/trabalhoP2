<?php
abstract class Componente implements IComponente
{
	public function __construct(
		protected ?string $class = null,
		protected ?string $style = null
	) {
	}

	abstract public function criar();

	public function classString()
	{
		return $this->class != null ? "class={$this->class}" : "";
	}

	public function styleString()
	{
		return $this->style != null ? "style={$this->style}" : "";
	}
}
?>