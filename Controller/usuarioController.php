<?php
class usuarioController
{
	use ConversorStdClass;

	public function login_usuario(): void
	{
		if (empty($_POST)) {
			require_once "View/form_login.php";
		} else {
			$usuarioDAO = new usuarioDAO();
			$usuarioParaLogin = new Usuario(
				email: $_POST['email'],
				senha: $_POST['senha']
			);
			$usuarioEncontrado = $this->stdClassToModelClass(
				$usuarioDAO->buscar_um_usuario($usuarioParaLogin),
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

	public function mostrar_perfil(): void {

		$usuarioDAO = new usuarioDAO();
		if (isset($_SESSION['usuario_id'])) {
			$usuarioEncontrado = $this->stdClassToModelClass(
				$usuarioDAO->buscar_um_usuario(new Usuario(id: $_SESSION['usuario_id'])),
				Usuario::class
			);
		} else {
			header("Location: /trabalhoP2/form_login");
			exit();
		}

		require_once "View/perfil_usuario.php";
	}

	public function logout_usuario(): void
	{
		session_unset();
		session_destroy();

		header('Location: /trabalhoP2/');
		exit();
	}

	public function cadastrar_usuario(): void
	{
		if (empty($_POST)) {
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

	public function buscar_usuario_por_email(): string|bool|null
	{
		if (empty($_GET)) {
			return json_encode(["erro" => "Não foi possível buscar os dados"]);
		} else {
			$usuariosEncontrados = (new usuarioDAO())->buscar_emails(new Usuario(email: $_GET['email']));
			echo json_encode($usuariosEncontrados);
			return null;
		}
	}
}
?>