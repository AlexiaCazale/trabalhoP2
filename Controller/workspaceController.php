<?php
    class workspaceController
    {
        use ConversorStdClass;

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
            /*
            $atividade_arr = [
                "id_atividade" => 0,
                "nome_atividade" => "Teste",
                "data_entrega_atividade" => (new DateTime())->setTime(0, 0, 0, 0),
                "data_criacao_atividade" => (new DateTime())->setTime(0, 0, 0, 0),
                "descricao_atividade" => "Teste descrição"
            ];
            var_dump($this->stdClassToModelClass((object) $atividade_arr, Atividade::class));
            */ 


            //require_once "View/workspace.php";
        }

    }

?>