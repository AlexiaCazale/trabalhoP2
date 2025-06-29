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
		if (isset($this->rotas[$metodo][$uri])) {
			$dados_rota = $this->rotas[$metodo][$uri];
			$classe = $dados_rota[0];
			$metodo = $dados_rota[1];
			$obj = new $classe();
			return $obj->$metodo();
		} else {
			echo "Rota Inválida";
		}
	}
}

//GET
$route = new Rotas();
$route->get("/", [inicioController::class, "inicio"]); // Ou apenas "/" se o basePath for tratado antes

$route->get("/criar_atividade", [workspaceController::class, "cadastrarAtividadeEmWorkspace"]);

$route->get("/criar_workspace", [workspaceController::class, "cadastrarWorkspace"]);

$route->get("/form_login", [usuarioController::class, "loginUsuario"]);

$route->get("/logout", [usuarioController::class, "logoutUsuario"]);

$route->get("/form_cadastro", [usuarioController::class, "cadastrarUsuario"]);

$route->get("/workspace", [workspaceController::class, "mostrarAtividadeWorkspace"]);

$route->get("/buscar_usuario", [usuarioController::class, "buscarUsuarioPorEmail"]);

$route->get("/perfil", [usuarioController::class, "mostrarPerfil"]);

//POST
$route->post("/criar_atividade", [workspaceController::class, "cadastrarAtividadeEmWorkspace"]);

$route->post("/form_login", [usuarioController::class, "loginUsuario"]);

$route->post("/form_cadastro", [usuarioController::class, "cadastrarUsuario"]);

$route->post("/criar_workspace", [workspaceController::class, "cadastrarWorkspace"]);

$route->post("/usuario_em_workspace", [workspaceController::class, "cadastrarUsuarioNoWorkspace"]);

$route->post("/usuario_em_atividade", [atividadeController::class, "cadastrarUsuarioNaAtividade"]);

?>