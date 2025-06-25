<?php
class workspaceController
{
	public function cadastrar_workspace()
	{

		if (empty($_POST)) {
			ViewRenderer::render("criar_workspace");
		} else {
			$workspaceDAO = new workspaceDAO();

			$workspaceCriado = new Workspace(
				id: 0,
				nome: $_POST['nome'],
				descricao: $_POST['descricao']
			);

			$workspaceDAO->cadastrar_workspace($workspaceCriado);
			$id_workspace = $workspaceDAO->buscar_ultimo_id();

			var_dump($id_workspace);
			
			header("Location: /trabalhoP2/workspace?id={$id_workspace}");
			exit();
		}
	}

	public function cadastrar_usuario_no_workspace()
	{
		// TODO Alterar os $_GET por $_POST

		$_POST ? var_dump($_POST) : var_dump("Nada enviado");
	}

	public static function buscar_usuarios_em_workspace(Workspace $workspace)
	{
		$workspaceDAO = new workspaceDAO();
		$usuarios = $workspaceDAO->buscar_usuarios_do_workspace($workspace);

		foreach ($usuarios as $usuario) {
			$workspace->setUsuarios(ConversorStdClass::stdClassToModelClass($usuario, Usuario::class));
		}

	}

	public function cadastrar_atividade_em_workspace()
	{
		if (empty($_POST)) {
			require_once "View/criar_atividade.php";
		} else {
			$atividade = new Atividade(
				id: 0,
				nome: $_POST['nome_atv'],
				descricao: $_POST['desc_atv'],
				dataEntrega: $_POST['data_ent_atv'],
				dataCriacao: time(),
				workspace: new Workspace($_POST['id_workspace']),
				comentarios: null // TODO Decidir se os comentários serão removidos
			);

			$atividadeDAO = new atividadeDAO();
			$atividadeDAO->cadastrar_atividade($atividade);
		}
	}

	public function alterar_workspace()
	{

		require_once "View/editar_workspace.php";
	}

	public function mostrar_atividade_workspace()
	{
		if (empty($_GET['id'])) {
			header("Location: /trabalhoP2");
			exit();
		} else {
			$workspaceDAO = new workspaceDAO();
			
			$workspace = new Workspace($_GET['id']);

			$workspace = ConversorStdClass::stdClassToModelClass($workspaceDAO->buscar_um_workspace($workspace), Workspace::class);

			foreach ($workspaceDAO->buscar_usuarios_do_workspace($workspace) as $usuario) {
				$workspace->setUsuarios(ConversorStdClass::stdClassToModelClass($usuario, Usuario::class));			
			}

			foreach ($workspaceDAO->buscar_atividades_do_workspace($workspace) as $atividade) {
				$workspace->setAtividades(ConversorStdClass::stdClassToModelClass($atividade, Atividade::class));
			}

			$avatares = CompositionHandler::createUsersAvatar($workspace, class: "'avatar-stack justify-content-center flex-row'");

		}
		
		ViewRenderer::render("workspace", [
			"avatares" => $avatares,
			"workspace" => $workspace
		]);
	}

}

?>