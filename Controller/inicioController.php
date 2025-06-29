<?php
class inicioController
{
	public function inicio()
	{
		// Esse método faz com que a home só possa ser carregada por esse controlador, isso limita a  
		// utilização dessa página

		$ul = CompositionHandler::createQuickAccess();

		if (isset($_SESSION['usuario_id'])) {
			$usuarioDAO = new usuarioDAO();
			$usuarioLogado = new Usuario(id: $_SESSION['usuario_id']);
			$workspacesEncontrados = $usuarioDAO->buscarWorkspaces($usuarioLogado);
			foreach ($workspacesEncontrados as $workspaces) {
				$workspaceHidratado = ConversorStdClass::stdClassToModelClass($workspaces, Workspace::class);
				workspaceController::buscarUsuariosEmWorkspace($workspaceHidratado);
				$usuarioLogado->setWorkspaces($workspaceHidratado);
			}

			$tagWorkspaces = CompositionHandler::createWorkspaces($usuarioLogado);
		} else {
			$tagWorkspaces = new div();
		}

		ViewRenderer::render("home", [
			"tagWorkspaces" => $tagWorkspaces,
			"ul" => $ul
		]);
	}
}
?>