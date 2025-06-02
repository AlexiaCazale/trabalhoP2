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

        public function cadastrar_workspace(){
            
        }



        public function mostrar_atividade_workspace(){
            
        }
    }
?>