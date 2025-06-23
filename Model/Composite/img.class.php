<?php

class img extends Componente
{
    public function __construct(
        private string $src,
        protected ?string $class = null,
		protected ?string $style = null
    ) {
    }

    public function criar()
    {
        echo "<img {$this->classString()} {$this->styleString()} src={$this->src}/>";
    }
}

?>