<?php
class workspaceController
{
	public function buscarAdminDoWorkspace(Workspace $workspace): ?Workspace
	{
		$workspaceDAO = new workspaceDAO();

		$adminObjeto =
			ConversorStdClass::stdClassToModelClass(
				$workspaceDAO->buscarAdminDoWorkspace($workspace),
				Usuario::class
			);

		if ($adminObjeto) {
			$workspace->setAdmin($adminObjeto);
		} else {
			throw new Exception("Não foi possível encontrar o administrador do workspace", 404);
		}

		return $workspace;
	}

	public function cadastrarWorkspace()
	{
		UserAuth::userIsLogged();

		if (empty($_POST)) {
			ViewRenderer::render("criar_workspace");
		} else {
			$workspaceDAO = new workspaceDAO();

			$workspaceCriado = new Workspace(
				id: 0,
				nome: $_POST['nome'],
				descricao: $_POST['descricao']
			);

			$workspaceCriado->setUsuarios(new Usuario($_SESSION['usuario_id']));

			$workspaceDAO->cadastrarWorkspace($workspaceCriado);
			$id_workspace = $workspaceDAO->buscarUltimoId();

			$workspaceDAO->cadastrarUsuarioNoWorkspace(
				new Workspace($id_workspace),
				new Usuario($_SESSION["usuario_id"])
			);

			header("Location: /trabalhoP2");
			exit();
		}
	}

	public function cadastrarUsuarioNoWorkspace(?Workspace $workspaceInjection = null, ?Usuario $usuarioInjection = null)
	{
		$workspace = null;
		$usuario = null;

		if ($workspaceInjection !== null && $usuarioInjection !== null) {
			$workspace = $workspaceInjection;
			$usuario = $usuarioInjection;
		} else if (isset($_POST['email'], $_POST['id_workspace'])) {
			$usuario = new Usuario(email: $_POST['email']);
			$workspace = new Workspace($_POST['id_workspace']);
		} else if (isset($_POST['id_usuario'], $_POST['id_workspace'])) {
			$usuario = new Usuario(id: $_POST['id_usuario']);
			$workspace = new Workspace($_POST['id_workspace']);
		}

		if ($usuario === null || $workspace === null) {
			# TODO Mandar para página de erro
			return;
		}

		$usuarioDAO = new usuarioDAO();
		$workspaceDAO = new workspaceDAO();

		// Busca o usuário no banco
		$usuarioEncontrado = $usuarioDAO->buscarUmUsuario($usuario);
		if (!$usuarioEncontrado) {
			throw new Exception("Usuário não encontrado com os dados informados.", 404);
		}
		$usuario = ConversorStdClass::stdClassToModelClass(
			$usuarioEncontrado,
			Usuario::class
		);

		$workspaceDAO->cadastrarUsuarioNoWorkspace($workspace, $usuario);

		header("Location: /trabalhoP2/workspace?id=" . $workspace->getId());
		exit();
	}

	public function removerUsuarioDoWorkspace()
{
    UserAuth::userIsLogged();

    if (isset($_GET['id_workspace']) && isset($_GET['id_usuario'])) {
        $workspaceId = $_GET['id_workspace'];
        $usuarioARemoverId = $_GET['id_usuario'];

        $workspace = new Workspace($workspaceId);
        $usuario = new Usuario($usuarioARemoverId);
        $workspaceDAO = new workspaceDAO();

        // Busca os dados completos do workspace, incluindo o admin
        $workspaceCompleto = ConversorStdClass::stdClassToModelClass(
            $workspaceDAO->buscarUmWorkspace($workspace),
            Workspace::class
        );
        $this->buscarAdminDoWorkspace($workspaceCompleto);

        if ($workspaceCompleto->getAdmin()->getId() == $usuario->getId()) {
            ViewRenderer::renderErrorPage(
                403, // Forbidden
                "Ação não permitida",
                "O administrador não pode ser removido do workspace. Para removê-lo, você deve primeiro transferir a administração para outro membro."
            );
            exit();
        }

        if (!PermissionManager::loggedUserIsAdmin($workspace)) {
            ViewRenderer::renderErrorPage(403, "Acesso Negado", "Apenas o administrador pode remover um usuário do workspace.");
            exit();
        }

        $workspaceDAO->removerUsuarioDeTodasAtividadesNoWorkspace($workspace, $usuario);
        $workspaceDAO->removerUsuarioDoWorkspace($workspace, $usuario);

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        throw new Exception("Dados insuficientes para remover o usuário.", 400);
    }
}

	public static function buscarUsuariosEmWorkspace(Workspace $workspace)
	{
		$workspaceDAO = new workspaceDAO();
		$usuarios = $workspaceDAO->buscarUsuariosDoWorkspace($workspace);

		$workspace->limparUsuarios();

		foreach ($usuarios as $usuario) {
			$workspace->setUsuarios(ConversorStdClass::stdClassToModelClass($usuario, Usuario::class));
		}
	}

	public function cadastrarAtividadeEmWorkspace()
	{
		$dataCriacao = date('Y-m-d H:i:s');

		if (empty($_POST)) {
			ViewRenderer::render("criar_atividade");
		} else {
			// Combina a data do formulário com um horário padrão
			$dataEntregaCompleta = $_POST['data_ent_atv'] . ' 23:59:59';

			$atividade = new Atividade(
				id: 0,
				nome: $_POST['nome_atv'],
				descricao: $_POST['desc_atv'],
				dataEntrega: $dataEntregaCompleta, // Passa a string completa
				dataCriacao: date('Y-m-d H:i:s'), // Já está no formato correto
				workspace: new Workspace($_POST['id_workspace'])
			);

			(new atividadeDAO())->cadastrarAtividade($atividade);

			header("Location: {$_SERVER['HTTP_REFERER']}");
			exit();
		}
	}


	public function alterarWorkspace()
	{
		if ($_GET) {
			if (empty($_GET['id'])) {
				throw new Exception("Erro ao buscar workspace para alterar", 403);
			}
			$workspaceDAO = new workspaceDAO();
			$workspace = new Workspace($_GET['id']);

			if (!PermissionManager::loggedUserIsAdmin($workspace)) {
				ViewRenderer::renderErrorPage(403, "Acesso Negado", "Apenas o administrador pode desativar o workspace.");
				exit();
			}

			$workspace = ConversorStdClass::stdClassToModelClass(
				$workspaceDAO->buscarUmWorkspace($workspace),
				Workspace::class
			);

			ViewRenderer::render("editar_workspace", [
				"workspace" => $workspace
			]);
		} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$workspaceDAO = new workspaceDAO();

			$workspace = new Workspace(
				id: $_POST['id_workspace'],
				nome: $_POST['nome'],
				descricao: $_POST['descricao']
			);

			$workspaceDAO->alterarWorkspace($workspace);

			header("Location: /trabalhoP2");
			exit();
		}
	}

	public function desativarWorkspace()
	{
		$workspace = new Workspace($_GET["id"]);

		if (!PermissionManager::loggedUserIsAdmin($workspace)) {
			ViewRenderer::renderErrorPage(403, "Acesso Negado", "Apenas o administrador pode desativar o workspace.");
			exit();
		}

		$workspaceDAO = new workspaceDAO();
		$workspaceDAO->desativarWorkspace($workspace);
		header("Location: /trabalhoP2/");
		die();
	}

	public function mostrarAtividadeWorkspace()
	{
		UserAuth::userIsLogged(); //

		if (empty($_GET['id'])) {
			header("Location: /trabalhoP2"); //
			exit(); //
		} else {
			$workspaceDAO = new workspaceDAO(); //
			$atividadeDAO = new atividadeDAO(); // Instantiate atividadeDAO directly here

			$workspace = new Workspace($_GET['id']); //
			$usuario = new Usuario($_SESSION['usuario_id']); //

			$usuarioDAO = new usuarioDAO();
			$usuariosTodos = $usuarioDAO->buscarUsuarios();

			if (!$this->usuarioFazParteDoWorkspace($workspace, $usuario)) {
				ViewRenderer::renderErrorPage(404, "Usuário não encontrado", "O usuário inserido não foi encontrado no workspace atual!");
			}

			$workspace = ConversorStdClass::stdClassToModelClass($workspaceDAO->buscarUmWorkspace($workspace), Workspace::class); //

			foreach ($workspaceDAO->buscarUsuariosDoWorkspace($workspace) as $usuarioData) {
				$workspace->setUsuarios(ConversorStdClass::stdClassToModelClass($usuarioData, Usuario::class)); //
			}

			$this->buscarAdminDoWorkspace($workspace);

			foreach ($workspaceDAO->buscarAtividadesDoWorkspace($workspace) as $atividadeData) {
				$atividade = ConversorStdClass::stdClassToModelClass($atividadeData, Atividade::class); //

				$usuariosDaAtividade = $atividadeDAO->buscarUsuariosEmAtividade($atividade);
				foreach ($usuariosDaAtividade as $usuarioAtividadeData) {
					$atividade->setUsuarios(ConversorStdClass::stdClassToModelClass($usuarioAtividadeData, Usuario::class));
				}

				$workspace->setAtividades($atividade); //
			}

			$avatares = CompositionHandler::createUsersAvatar($workspace, class: "'avatar-stack justify-content-center flex-row'"); //
		}

		ViewRenderer::render("workspace", [
			"avatares" => $avatares,
			"workspace" => $workspace,
			"usuarios" => $usuariosTodos,
		]); //
	}

	private function usuarioFazParteDoWorkspace(Workspace $workspace, Usuario $usuario)
	{
		return (new workspaceDAO())->usuarioEstaNoWorkspace($workspace, $usuario);
	}
}
