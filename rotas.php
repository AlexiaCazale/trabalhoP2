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

	//GET
	$route = new Rotas();
	$route->get("/", [inicioController::class, "inicio"]); // Ou apenas "/" se o basePath for tratado antes

	$route->get("/criar_atividade", [workspaceController::class, "cadastrar_atividade"]);
	
	$route->get("/criar_workspace", [workspaceController::class, "cadastrar_workspace"]);
	
	$route->get("/form_login", [usuarioController::class, "login_usuario"]);

	$route->get("/logout", [usuarioController::class, "logout_usuario"]);

	$route->get("/form_cadastro", [usuarioController::class, "cadastrar_usuario"]);
	
	$route->get("/workspace", [workspaceController::class, "mostrar_atividade_workspace"]);

	$route->get("/buscar_usuario", [usuarioController::class, "buscar_usuario_por_email"]);
	
	//POST
	$route->post("/criar_atividade", [workspaceController::class, "cadastrar_atividade"]);

	$route->post("/form_login", [usuarioController::class, "login_usuario"]);
	
	$route->post("/form_cadastro", [usuarioController::class, "cadastrar_usuario"]);

	$route->post("/criar_workspace", [workspaceController::class, "cadastrar_workspace"]);

?>