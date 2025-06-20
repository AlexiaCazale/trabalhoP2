<?php
    class workspaceController
    {
        use ConversorStdClass;

        public function cadastrar_workspace(){

            if (empty($_POST)) 
            {
                require_once "View/criar_workspace.php";
            } 
            else 
            {   
                $workspaceDAO = new workspaceDAO();

                $workspaceCriado = new Workspace(
                    id: 0,
                    nome: $_POST['nome'],
                    descricao: $_POST['descricao']
                );

                $workspaceDAO->cadastrar_workspace($workspaceCriado);
            }
        }

        public function cadastrar_usuarios_em_workspace(Workspace $workspace, array $emails_de_usuarios) 
        {
            $usuarioDAO = new usuarioDAO;

            $ultimoId = (new workspaceDAO)->get_db()->lastInsertId();
            
            $workspace->setId($ultimoId);

            foreach ($emails_de_usuarios as $i) 
            {
                $usuario = new Usuario(email: $i);
                $usuarioEncontrado = $this->stdClassToModelClass($usuarioDAO->buscar_um_usuario($usuario), Usuario::class);
            }    
        }

        public function cadastrar_atividade_em_workspace(){
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


            require_once "View/workspace.php";
        }

    }

?>