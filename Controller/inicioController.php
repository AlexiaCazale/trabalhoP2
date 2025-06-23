<?php
class inicioController
{
	use ConversorStdClass;

	public function inicio()
	{
		// Esse método faz com que a home só possa ser carregada por esse controlador, isso limita a  
		// utilização dessa página

		$ul = CompositionHandler::createQuickAccess();

		if (isset($_SESSION['usuario_id'])) {
			$usuarioDAO = new usuarioDAO();
			$usuarioLogado = new Usuario(id: $_SESSION['usuario_id']);
			$workspacesEncontrados = $usuarioDAO->buscar_workspaces($usuarioLogado);
			foreach ($workspacesEncontrados as $workspaces) {
				$workspaceHidratado = $this->stdClassToModelClass($workspaces, Workspace::class);
				workspaceController::buscar_usuarios_em_workspace($workspaceHidratado);
				$usuarioLogado->setWorkspaces($workspaceHidratado);
			}

			$tagWorkspaces = CompositionHandler::createWorkspaces($usuarioLogado);
		} else {
			$tagWorkspaces = new div();
		}

		require_once "View/home.php";
	}
}
?>