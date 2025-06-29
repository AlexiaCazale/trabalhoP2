<?php

class atividadeController {

    public function cadastrarUsuarioNaAtividade(?Atividade $atividade = null, ?Usuario $usuario = null)
	{
		// TODO Alterar os $_GET por $_POST

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
	}

    public function buscarUsuariosEmAtividade() {
        $atividadeDAO = new atividadeDAO();
        $atividade = new Atividade();
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