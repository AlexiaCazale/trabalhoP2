<?php
	require_once "Model/Composite/componente.php";
	class inicioController
	{
		public function inicio()
		{
			$ul = new ul();
			$ul->setElemento(new li(new a("/trabalhoP2/form_cadastro", "Cadastro"))); 

			$ul->setElemento(new li(new a("/trabalhoP2/form_login", "Login"))); 

			$ul->setElemento(new li(new a("/trabalhoP2/home", "Home"))); 

			$ul->setElemento(new li(new a("/trabalhoP2/criar_workspace", "Criar Workspace"))); 

			$ul->setElemento(new li(new a("/trabalhoP2/workspace", "Workspace"))); 

			$ul->setElemento(new li(new a("/trabalhoP2/criar_atividade", "Criar atividade")));
						
			require_once "View/home.php";
		}
	}
?>