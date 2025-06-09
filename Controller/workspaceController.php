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

        public function cadastrar_atividade(){
            require_once "View/criar_atividade.php";
        }

        public function alterar_workspace(){

        require_once "View/editar_workspace.php";
        }

        public function mostrar_atividade_workspace(){
            require_once "View/workspace.php";
        }

    }

?>