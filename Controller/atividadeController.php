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
		$atividadeDAO = new atividadeDAO();
		$atividadeDAO->cadastrarUsuarioNaAtividade($atividade, $usuario);

        header("Location: {$_SERVER['HTTP_REFERER']}");
		exit();
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

		header("Location: {$_SERVER['HTTP_REFERER']}");
		exit();
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

		header("Location: {$_SERVER['HTTP_REFERER']}");
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