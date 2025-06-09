<?php
	class usuarioController
    {
        private $param;
		public function __construct()
		{
			$this->param = Conexao::getInstancia();
		}

        public function login_usuario(){
			require_once "View/form_login.php";
		}

        public function cadastrar_usuario(){
			require_once "View/form_cadastro.php";
		}
    }
?>