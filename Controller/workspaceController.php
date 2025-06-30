<?php
class workspaceController
{
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

			$workspaceDAO->cadastrarWorkspace($workspaceCriado);
			$id_workspace = $workspaceDAO->buscarUltimoId();
			
			$workspaceDAO->cadastrarUsuarioNoWorkspace(
				new Workspace($id_workspace),
				new Usuario($_SESSION["usuario_id"])
			);
			
			var_dump($id_workspace);

			header("Location: {$_SERVER['HTTP_REFERER']}");
			exit();
		}
	}

	public function cadastrarUsuarioNoWorkspace(?Workspace $workspace = null, ?Usuario $usuario = null)
	{

		if (empty($_POST) and ($workspace === null and $usuario === null)) {
			return;
		} else if ($workspace == null and $usuario === null) {
			$usuario = new Usuario(email: $_POST['email']);
			$workspace = new Workspace($_POST['id_workspace']);
		}
		$usuarioDAO = new usuarioDAO();
		$workspaceDAO = new workspaceDAO();
		try {
			$usuario = ConversorStdClass::stdClassToModelClass(
				$usuarioDAO->buscarUmUsuario($usuario),
				Usuario::class
			);
		} catch (Exception $e) {
			die("Erro ao buscar o usuário: " . $e->getMessage());
		}
		$workspaceDAO->cadastrarUsuarioNoWorkspace($workspace, $usuario);

		header("Location: {$_SERVER['HTTP_REFERER']}");
		exit();
	}

	public static function buscarUsuariosEmWorkspace(Workspace $workspace)
	{
		$workspaceDAO = new workspaceDAO();
		$usuarios = $workspaceDAO->buscarUsuariosDoWorkspace($workspace);

		$workspace->limparUsuarios(); // ✅ Limpa antes de adicionar

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
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			// Carregar a view com dados para edição
			if (empty($_GET['id'])) {
				header("Location: /trabalhoP2");
				exit();
			}
			$workspaceDAO = new workspaceDAO();
			$workspace = new Workspace($_GET['id']);
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

			header("Location: {$_SERVER['HTTP_REFERER']}");
			exit();
		}
	}



	public function desativarWorkspace()
	{
		$workspace = new workspace($_GET["id"]);
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
                // TODO Renderizar a View de erro
                header("Location: /trabalhoP2"); //
                exit(); //
            }

            $workspace = ConversorStdClass::stdClassToModelClass($workspaceDAO->buscarUmWorkspace($workspace), Workspace::class); //

            foreach ($workspaceDAO->buscarUsuariosDoWorkspace($workspace) as $usuarioData) {
                $workspace->setUsuarios(ConversorStdClass::stdClassToModelClass($usuarioData, Usuario::class)); //
            }

            foreach ($workspaceDAO->buscarAtividadesDoWorkspace($workspace) as $atividadeData) {
                $atividade = ConversorStdClass::stdClassToModelClass($atividadeData, Atividade::class); //

                // Directly hydrate activity's users here, removing the controller instantiation
                $usuariosDaAtividade = $atividadeDAO->buscarUsuariosEmAtividade($atividade); //
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

	private function usuarioFazParteDoWorkspace(Workspace $workspace, Usuario $usuario) {
		return (new workspaceDAO())->usuarioEstaNoWorkspace($workspace, $usuario);
	}

}

?>