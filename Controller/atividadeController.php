<?php

class atividadeController {

    public function cadastrarUsuarioNaAtividade(?Atividade $atividade = null, ?Usuario $usuario = null)
	{

		if (empty($_POST) and ($atividade === null and $usuario === null)) {
			return;
		} else if ($atividade == null and $usuario === null) {
			$usuario = new Usuario(email: $_POST['email']);
			$atividade = new Atividade($_POST['id_atividade']);
		}
		$usuarioDAO = new usuarioDAO();
		$atividadeDAO = new atividadeDAO();
		try {
			$usuario = ConversorStdClass::stdClassToModelClass(
				$usuarioDAO->buscarUmUsuario($usuario),
				Usuario::class
			);
		} catch (Exception $e) {
			die("Erro ao buscar o usuário: " . $e->getMessage());
		}
		$atividadeDAO->cadastrarUsuarioNaAtividade($atividade, $usuario);

        var_dump($_SERVER['HTTP_REFERER']);
	}

    public function alterarAtividade()
	{
        $atividadeDAO = new AtividadeDAO();

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

		header("Location: /trabalhoP2/workspace?id={$atividade->getWorkspace()->getId()}");
	}

	public function desativarAtividade()
	{
		$atividade = new Atividade($_GET["id"]);
		$atividadeDAO = new atividadeDAO();

		$atividadeDAO->desativarAtividade($atividade);

		$atividade->setWorkspace(
			ConversorStdClass::stdClassToModelClass(
				$atividadeDAO->buscarWorkspaceDaAtividade($atividade),
				Workspace::class
			)
		);

		header("Location: /trabalhoP2/workspace?id=" . $atividade->getWorkspace()->getId());
		exit();
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