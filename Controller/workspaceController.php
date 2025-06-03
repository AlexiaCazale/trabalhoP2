<?php
    class workspaceController
    {
        private $param;
		public function __construct()
		{
			$this->param = Conexao::getInstancia();
		}

        public function listar(){
        require_once "View/home.php";
        }

        public function cadastrar_workspace(){

        require_once "View/criar_workspace.php";
        }

        public function alterar_workspace(){

        require_once "View/editar_workspace.php";
        }

    }

?>