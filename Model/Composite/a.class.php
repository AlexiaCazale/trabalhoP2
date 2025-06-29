<?php
class a extends Componente
{
	public function __construct(
		private string $rota,
		private ?string $texto = null,
		protected ?string $tagId = null,
		protected ?string $class = null,
		protected ?string $style = null,
		protected ?string $iconeAntes = null,  // Novo: ícone antes do texto
		protected ?string $iconeDepois = null  // Novo: ícone depois do texto
	) {
		if ($this->style === null) {
			$this->style = "text-decoration: none;";
		} elseif (!str_contains($this->style, "text-decoration")) {
			$this->style .= " text-decoration: none;";
		}
	}

	public function criar()
	{
		$conteudo = "";
		if ($this->iconeAntes) {
			$conteudo .= $this->iconeAntes . " ";
		}
		$conteudo .= $this->texto;
		if ($this->iconeDepois) {
			$conteudo .= " " . $this->iconeDepois;
		}

		echo "<a {$this->classTagId()} {$this->classString()} {$this->styleString()} href='{$this->rota}'>$conteudo</a>";
	}
}
?>
