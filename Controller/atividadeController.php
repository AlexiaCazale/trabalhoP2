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
		
	}

	public function desativarAtividade()
	{
		
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