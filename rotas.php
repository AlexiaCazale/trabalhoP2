<?php
	class rotas
	{
		private array $rotas = array();
		
		public function get(string $nome, array $dados)
		{
			$this->rotas['GET'][$nome] = $dados;
		}
		public function post(string $nome, array $dados)
		{
			$this->rotas['POST'][$nome] = $dados;
		}
		public function verificar_rota(string $metodo, string $uri)
		{
			if(isset($this->rotas[$metodo][$uri]))
			{
				$dados_rota = $this->rotas[$metodo][$uri];
				$classe = $dados_rota[0];
				$metodo = $dados_rota[1];
				$obj = new $classe();
				return $obj->$metodo();
			}
			else
			{
				echo "Rota Inválida";
			}
		}
	}


	$route = new Rotas();
	$route->get("/", [inicioController::class,"inicio"]);
	$route->get("/criar_atividade", [nome_do_controller::class,"forms_atividade"]);
	$route->get("/criar_workspace", [nome_do_controller::class,"forms_workspace"]);
	$route->get("/form_cadastro", [nome_do_controller::class,"forms_cadastro"]);
	$route->post("/form_login", [nome_do_controller::class,"forms_login"]);
	$route->get("/home", [nome_do_controller::class,"buscar_workspaces"]);
	$route->get("/workspace", [nome_do_controller::class,"mostrar_atividade_workspace"]);
	
?>