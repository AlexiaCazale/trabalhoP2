<?php

class atividadeController {

    public function cadastrarUsuarioEmAtividade() {

    }

    public function buscarUsuariosEmAtividade() {
        $atividadeDAO = new atividadeDAO();
        $atividade = new Atividade();
		$usuarios = $atividadeDAO->buscarUsuariosEmAtividade($atividade);

		foreach ($usuarios as $usuario) {
			$atividade->setUsuarios(ConversorStdClass::stdClassToModelClass($usuario, Usuario::class));
		}
    }

}

?>