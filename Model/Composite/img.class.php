<?php

class img extends Componente
{
	public function __construct(
		private string $src,
		protected ?string $tagId = null,
		protected ?string $class = null,
		protected ?string $style = null,
		private array $attributes = []
	) {
	}

	public function criar()
	{
		$htmlAttributes = "";
		foreach ($this->attributes as $attrName => $attrValue) {
			// Garante que os valores dos atributos estejam escapados corretamente para HTML
			$htmlAttributes .= " " . htmlspecialchars($attrName) . "=\"" . htmlspecialchars($attrValue) . "\"";
		}

		// Garante que o valor do atributo src também esteja entre aspas e escapado
		echo "<img {$this->classTagId()} {$this->classString()} {$this->styleString()} src=\"" . htmlspecialchars($this->src) . "\"{$htmlAttributes}/>";
	}
}

?>