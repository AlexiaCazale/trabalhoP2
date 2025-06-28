<?php

class atividadeController {

    public function cadastrar_usuario_em_atividade() {

    }

    public function buscar_usuarios_em_atividade() {
        $atividadeDAO = new atividadeDAO();
		$usuarios = $atividadeDAO->buscar_usuarios_da_($workspace);

		foreach ($usuarios as $usuario) {
			$workspace->setUsuarios(ConversorStdClass::stdClassToModelClass($usuario, Usuario::class));
		}
    }

}

?>