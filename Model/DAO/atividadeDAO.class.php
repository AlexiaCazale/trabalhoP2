<?php 
    class atividadeDAO
    {
        public function __construct(private $db = null){}

        public function buscar_atividades()
		{
			$sql = "SELECT * FROM atividade";
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
				die("Problema ao buscar as atividades");
			}
		}

        public function cadastrar_atividade(){

        }

        public function buscar_uma_atividade($curso)
		{
			$sql = "SELECT * FROM atividade WHERE idAtividade = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $curso->getIdAtividade());
				$stm->execute();
				$this->db = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				$this->db = null;
				echo $e->getMessage();
				echo $e->getCode();
				die();
			}
		}
    }
?>