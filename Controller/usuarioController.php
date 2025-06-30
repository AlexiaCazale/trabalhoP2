<?php
class usuarioController
{
	// ... (outros métodos como loginUsuario, logoutUsuario, etc. permanecem os mesmos)
    public function loginUsuario(): void
	{
		if (empty($_POST)) {
			ViewRenderer::render("form_login");
		} else {
			$usuarioDAO = new usuarioDAO();
			$usuarioParaLogin = new Usuario(
				email: $_POST['email'],
				senha: $_POST['senha']
			);
			$usuarioEncontrado = ConversorStdClass::stdClassToModelClass(
				$usuarioDAO->buscarUmUsuario($usuarioParaLogin),
				Usuario::class
			);
			if (
				password_verify(
					password: $usuarioParaLogin->getSenha(),
					hash: $usuarioEncontrado->getSenha()
				)
			) {
				$nomeCompleto = $usuarioEncontrado->getNome();
				$partesNome = explode(' ', $nomeCompleto); // Armazena o array em uma variável

				$_SESSION['usuario_nome'] = $nomeCompleto;
				$_SESSION['usuario_primeiro_nome'] = $partesNome[0]; // Pega o primeiro nome do array
				$_SESSION['usuario_ultimo_nome'] = end($partesNome); // Agora funciona, pois passamos uma variável
				$_SESSION['usuario_email'] = $usuarioEncontrado->getEmail();
				$_SESSION['usuario_id'] = $usuarioEncontrado->getId();
				session_regenerate_id(true);

				header('Location: /trabalhoP2/');
				exit();
			}


		}
	}

	public function mostrarPerfil(): void
	{

		$usuarioDAO = new usuarioDAO();
		if (isset($_SESSION['usuario_id'])) {
			$usuarioEncontrado = ConversorStdClass::stdClassToModelClass(
				$usuarioDAO->buscarUmUsuario(new Usuario(id: $_SESSION['usuario_id'])),
				Usuario::class
			);
		} else {
			header("Location: /trabalhoP2/form_login");
			exit();
		}

		ViewRenderer::render("perfil_usuario", [
			"usuario" => $usuarioEncontrado
		]);
	}

	public function logoutUsuario(): void
	{
		session_unset();
		session_destroy();

		header('Location: /trabalhoP2/');
		exit();
	}

	public function cadastrarUsuario(): void
	{
		if (empty($_POST)) {
			ViewRenderer::render("form_cadastro");
		} else {
			$usuarioDAO = new usuarioDAO();
			$usuario = new Usuario(
				id: 0,
				nome: filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS),
				email: filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL),
				senha: password_hash($_POST["senha"], PASSWORD_BCRYPT)
			);
			$usuarioDAO->cadastrarUsuario($usuario);

			header('Location: /trabalhoP2/form_login');
			exit();
		}
	}

	public function alterarDadosUsuario(): void
	{
		UserAuth::userIsLogged();
		
		// Apenas a lógica POST é necessária agora
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$usuarioDAO = new usuarioDAO();
			$usuario = new Usuario(
				id: $_SESSION['usuario_id'],
				nome: $_POST['nome'],
				email: $_POST['email']
			);
			$usuarioDAO->alterarUsuario($usuario);

			// Atualiza os dados da sessão
			$_SESSION['usuario_nome'] = $usuario->getNome();
			$partesNome = explode(' ', $usuario->getNome());
			$_SESSION['usuario_primeiro_nome'] = $partesNome[0];
			$_SESSION['usuario_ultimo_nome'] = end($partesNome);
			$_SESSION['usuario_email'] = $usuario->getEmail();

			header('Location: /trabalhoP2/perfil');
			exit();
		} else {
            // Se alguém tentar acessar a URL via GET, redireciona para o perfil
            header('Location: /trabalhoP2/perfil');
            exit();
        }
	}

	public function desativarConta(): void
	{
		UserAuth::userIsLogged();
		$usuarioDAO = new usuarioDAO();
		$usuario = new Usuario(id: $_SESSION['usuario_id']);
		$usuarioDAO->desativarUsuario($usuario);

		// Logout
		session_unset();
		session_destroy();

		header('Location: /trabalhoP2/');
		exit();
	}


	public function buscarUsuarioPorEmail(): string|bool|null
	{
		if (empty($_GET)) {
			return json_encode(["erro" => "Não foi possível buscar os dados"]);
		} else {
			$usuariosEncontrados = (new usuarioDAO())->buscarEmails(new Usuario(email: $_GET['email']));
			echo json_encode($usuariosEncontrados);
			return null;
		}
	}
}
?>