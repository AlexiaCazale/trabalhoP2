<?php

class span extends Componente {
    public function __construct(
        protected string $texto = "",
		protected ?string $tagId = null,
		protected ?string $class = null,
		protected ?string $style = null,

	) {
	}

    public function criar() 
    {
        echo "<span {$this->classTagId()} {$this->classString()} {$this->styleString()}>{$this->texto}</span>";
    }
}

?>