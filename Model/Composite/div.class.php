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
    public function setElemento($elemento)
    {
        $this->elementos[] = $elemento;
    }

    public function getElemento()
    {
        return $this->elementos;
    }

}
?>