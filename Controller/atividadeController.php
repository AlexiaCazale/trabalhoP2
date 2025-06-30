<?php

class atividadeController {

   public function cadastrarUsuarioNaAtividade(?Atividade $atividade = null, ?Usuario $usuario = null)
	{
		if (empty($_POST) and ($atividade === null and $usuario === null)) {
			return;
		} else if ($atividade == null and $usuario === null) {
			$usuario = new Usuario($_POST['id_usuario']);
			$atividade = new Atividade($_POST['id_atividade']);
		}

		$usuarioDAO = new usuarioDAO();
		$atividadeDAO = new atividadeDAO();

		// Busca o usuário no banco
		$usuarioEncontrado = $usuarioDAO->buscarUmUsuario($usuario);

		if (!$usuarioEncontrado) {
			die("Usuário não encontrado com o email informado.");
		}

		try {
			$usuario = ConversorStdClass::stdClassToModelClass(
				$usuarioEncontrado,
				Usuario::class
			);
		} catch (Exception $e) {
			die("Erro ao converter usuário: " . $e->getMessage());
		}

		$atividadeDAO->cadastrarUsuarioNaAtividade($atividade, $usuario);

		// Após cadastro, pode redirecionar para a página anterior ou workspace
		header("Location: " . ($_SERVER['HTTP_REFERER'] ?? "/trabalhoP2/workspace"));
		exit();
	}

	public function removerUsuarioDaAtividade()
	{
		if (isset($_GET['id_atividade']) && isset($_GET['id_usuario'])) {
			$atividade = new Atividade($_GET['id_atividade']);
			$usuario = new Usuario($_GET['id_usuario']);

			$atividadeDAO = new atividadeDAO();
			$atividade = ConversorStdClass::stdClassToModelClass(
				$atividadeDAO->buscarUmaAtividade($atividade), 
				Atividade::class);
			$atividade->setWorkspace(
				ConversorStdClass::stdClassToModelClass(
				$atividadeDAO->buscarWorkspaceDaAtividade($atividade), 
				Workspace::class));

			if (!PermissionManager::loggedUserIsAdmin($atividade->getWorkspace())) {
				ViewRenderer::renderErrorPage(403, "Acesso Negado", "Apenas o administrador pode remover um usuário.");
				exit();
			}

			$atividadeDAO = new atividadeDAO();
			$atividadeDAO->removerUsuarioDaAtividade($atividade, $usuario);

			// Redireciona de volta para a página anterior (o workspace)
			header("Location: " . $_SERVER['HTTP_REFERER']);
			exit();
		} else {
			throw new Exception("Nem todos os dados foram inseridos", 400);
		}
	}

    public function alterarAtividade()
	{
        $atividadeDAO = new atividadeDAO();

        if (isset($_POST)) {
            $atividade = new Atividade($_POST['id_atividade']);
            $atividade = ConversorStdClass::stdClassToModelClass
                (
                    $atividadeDAO->buscarUmaAtividade($atividade),
                    Atividade::class
                );
			$atividade->setWorkspace(ConversorStdClass::stdClassToModelClass
                (
                    $atividadeDAO->buscarWorkspaceDaAtividade($atividade),
                    Workspace::class
                ));

            $atividade->setNome($_POST['nome_atividade']);
            $atividade->setDescricao($_POST['descricao_atividade']);
            $atividade->setDataEntrega($_POST['data_entrega_atividade']);

            $atividadeDAO->alterarAtividade($atividade);
        }

		header("Location: {$_SERVER['HTTP_REFERER']}");
		exit();
	}

	public function desativarAtividade()
	{
		$atividade = new Atividade($_GET["id"]);

		$atividadeDAO = new atividadeDAO();
			$atividade = ConversorStdClass::stdClassToModelClass(
				$atividadeDAO->buscarUmaAtividade($atividade), 
				Atividade::class);
			$atividade->setWorkspace(
				ConversorStdClass::stdClassToModelClass(
				$atividadeDAO->buscarWorkspaceDaAtividade($atividade), 
				Workspace::class));

			if (!PermissionManager::loggedUserIsAdmin($atividade->getWorkspace())) {
				ViewRenderer::renderErrorPage(403, "Acesso Negado", "Apenas o administrador pode remover um usuário.");
				exit();
			}

		$atividadeDAO->desativarAtividade($atividade);

		header("Location: {$_SERVER['HTTP_REFERER']}");
		exit();
	}

	public function finalizarAtividade() 
	{
		$atividade = new Atividade($_GET('id'));
		(new atividadeDAO())->concluirAtividade($atividade);
	}


    public function buscarUsuariosEmAtividade(Atividade $atividade) {
        $atividadeDAO = new atividadeDAO();
		$usuarios = $atividadeDAO->buscarUsuariosEmAtividade($atividade);

		foreach ($usuarios as $usuario) {
			$atividade->setUsuarios(ConversorStdClass::stdClassToModelClass($usuario, Usuario::class));
		}
    }

    private function usuarioFazParteDaAtividade(Atividade $atividade, Usuario $usuario) {
		return (new atividadeDAO())->usuarioEstaNaAtividade($atividade, $usuario);
	}

}

?>