<?php
class inicioController
{
	public function inicio()
	{
		// Esse método faz com que a home só possa ser carregada por esse controlador, isso limita a  
		// utilização dessa página

		$ul = new ul();
		$ul->setElemento(new li(new a("/trabalhoP2/form_cadastro", "Cadastro")));

		$ul->setElemento(new li(new a("/trabalhoP2/form_login", "Login")));

		$ul->setElemento(new li(new a("/trabalhoP2", "Home")));

		$ul->setElemento(new li(new a("/trabalhoP2/criar_workspace", "Criar Workspace")));

		$ul->setElemento(new li(new a("/trabalhoP2/workspace", "Workspace")));

		$ul->setElemento(new li(new a("/trabalhoP2/criar_atividade", "Criar atividade")));

		require_once "View/home.php";
	}
}
?>