<?php

class img extends Componente
{
    public function __construct(
        private string $src,
        protected ?string $tagId = null,
        protected ?string $class = null,
		protected ?string $style = null
    ) {
    }

    public function criar()
    {
        echo "<img {$this->classTagId()} {$this->classString()} {$this->styleString()} src={$this->src}/>";
    }
}

?>