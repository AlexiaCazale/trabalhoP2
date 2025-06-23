<?php

class heading extends Componente
{
	public function __construct(
		private int $headingSize = 1,
		private string $text,
		protected ?string $tagId = null,
		protected ?string $class = null,
		protected ?string $style = null
	) {
	}

	public function criar()
	{
		if ($this->headingSize < 0) {
			$this->headingSize = 1;
		} else if ($this->headingSize > 6) {
			$this->headingSize = 6;
		}
		echo "<h{$this->headingSize} {$this->classTagId()} {$this->classString()} {$this->styleString()}>{$this->text}<h{$this->headingSize}/>";
	}
}
?>