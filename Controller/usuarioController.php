<?php
class usuarioController
{
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
				$_SESSION['usuario_nome'] = $usuarioEncontrado->getNome();
				$_SESSION['usuario_primeiro_nome'] = explode(' ', $usuarioEncontrado->getNome())[0];
				$_SESSION['usuario_ultimo_nome'] = end(explode(' ', $usuarioEncontrado->getNome()));
				$_SESSION['usuario_email'] = $usuarioEncontrado->getEmail();
				$_SESSION['usuario_id'] = $usuarioEncontrado->getId();
				session_regenerate_id(true);

				header('Location: /trabalhoP2/');
				exit();
			} else {
				var_dump("Senha errada");
			}

		}
	}

	public function mostrarPerfil(): void {

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
			"usuarioEncontrado" => $usuarioEncontrado
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

	public function detalharWorkspace(): void
	{
		UserAuth::userIsLogged();

		$workspaceDAO = new workspaceDAO();
		$usuarioDAO = new usuarioDAO();

		$workspace = $workspaceDAO->buscarPorId($_GET['id']); // Ajuste para pegar o workspace

		$usuariosEncontrados = $usuarioDAO->buscarUsuarios(); // Pega todos os usuários ativos

		ViewRenderer::render("detalhe_workspace", [
			"workspace" => $workspace,
			"usuariosEncontrados" => $usuariosEncontrados,
		]);
	}

}
?>