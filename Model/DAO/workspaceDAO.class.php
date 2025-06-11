<?php 
    class workspaceDAO
    {
        private $db;

        public function __construct()
        {
            $this->db = Conexao::getInstancia();
        }

        public function buscar_workspaces()
		{
			$sql = "SELECT * FROM workspace";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->execute();
				$this->db = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				$this->db = null;
				die("Problema ao buscar os workspaces");
			}
		}

		public function buscar_um_workspace(Workspace $workspace)
		{
			$sql = "SELECT * FROM workspace WHERE id_workspace = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->execute([
					"id_workspace" => $workspace->getId()
				]);
				$this->db = null;
			}
			catch(PDOException $e)
			{
				$this->db = null;
				die("Problema ao buscar um workspace");
			}
		}

		public function cadastrar_workspace(Workspace $workspace){
			$sql = 
			"INSERT 
			INTO usuario (nome_workspace, descricao_workspace) 
			VALUES (:nome, :descricao)";

			try
			{
				$stm = $this->db->prepare($sql);
				$stm->execute([
                    "nome" => $workspace->getNome(),
                    "descricao" => $workspace->getDescricao()
                ]);
				$this->db = null;
				return;
			}
			catch(PDOException $e)
			{
				$this->db = null;
				die("Problema ao cadastrar um workspace");
			}
        }

        public function mostrar_atividade_workspace(){
            
        }
    }
?>