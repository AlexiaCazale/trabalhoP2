<?php
	class usuarioController
    {
		use ConversorStdClass;

        public function login_usuario(): void
		{
			if (empty($_POST)) 
			{
				require_once "View/form_login.php";
			} 
			else 
			{
				$usuarioDAO = new usuarioDAO();
				$usuarioParaLogin = new Usuario(
					email: $_POST['email'],
					senha: $_POST['senha']
				);
				// Checar login
				$usuarioEncontrado = $usuarioDAO->buscar_um_usuario($usuarioParaLogin);
				$usuarioEncontrado = $this->stdClassToModelClass($usuarioEncontrado, Usuario::class);
				if (password_verify(
						password: $usuarioParaLogin->getSenha(), 
						hash: $usuarioEncontrado->getSenha()
						)) 
				{
					(new inicioController)->inicio();
				}
				else
				{
					var_dump("Senha errada");
				}
			}
		}

        public function cadastrar_usuario(): void
		{
			if (empty($_POST)) 
			{
				require_once "View/form_cadastro.php";
			} else {
				$usuarioDAO = new usuarioDAO();
				$usuario = new Usuario(
					id: 0,
					nome: filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS),
					email: filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL),
					senha: password_hash($_POST["senha"], PASSWORD_BCRYPT)
				);
				$usuarioDAO->cadastrar_usuario($usuario);
			}
		}
    }
?>