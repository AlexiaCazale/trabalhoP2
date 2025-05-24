<?php
	require_once "Models/componente.php";
	class inicioController
	{
		public function inicio()
		{
			$ul = new ul();
			$ul->setElemento(new li(new a("/trabalhoP2/criar_atividade", "Criar atividade")));
			
			$ul->setElemento(new li(new a("/trabalhoP2/criar_workspace", "Criar Workspace"))); 
			
			$ul->setElemento(new li(new a("/trabalhoP2/form_cadastro", "Cadastro"))); 

			$ul->setElemento(new li(new a("/trabalhoP2/form_login", "Login"))); 

			$ul->setElemento(new li(new a("/trabalhoP2/home", "Home"))); 

			$ul->setElemento(new li(new a("/trabalhoP2/workspace", "Workspace"))); 
			
			require_once "Views/home.php";
		}
	}
?>