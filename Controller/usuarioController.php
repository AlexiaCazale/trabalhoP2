<?php
	class usuarioController
    {
        private $param;
		use ConversorStdClass;
		
		public function __construct()
		{
			$this->param = Conexao::getInstancia();
		}

        public function login_usuario(){
			if (empty($_POST)) 
			{
				require_once "View/form_login.php";
			} 
			else 
			{
				$usuarioDAO = new UsuarioDAO();
				$usuario_para_login = new Usuario(
					email: $_POST['email'],
					senha: $_POST['senha']
				);
				var_dump($this->stdClassToModelClass($usuarioDAO->buscar_um_usuario($usuario_para_login), "Usuario"));
			}
		}

        public function cadastrar_usuario(){
			if (empty($_POST)) 
			{
				require_once "View/form_cadastro.php";
			} else {
				$usuarioDAO = new UsuarioDAO();
				$usuario = new Usuario(
					0,
					$_POST['nome'],
					$_POST['email'],
					$_POST['senha']
				);
				$usuarioDAO->cadastrar_usuario($usuario);
			}
		}
    }
?>