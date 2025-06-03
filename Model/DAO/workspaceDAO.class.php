<?php 
    class workspaceDAO
    {
        public function __construct(private $db = null){}

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

        public function inserir($workspace){
			$sql = "INSERT INTO workspace (nome, descricao) 
			VALUES (?, ?)";
			// TODO: Adicionar membros
			
			try {
				$stm = $this->db->prepare($sql);
				$stm->execute([$workspace['nome'], $workspace['descricao']]);
				return true;
			} catch(PDOException $e) {
				die("Erro ao inserir workspace: " . $e->getMessage());
			}
        }

        public function mostrar_atividade_workspace(){
            
        }
    }
?>