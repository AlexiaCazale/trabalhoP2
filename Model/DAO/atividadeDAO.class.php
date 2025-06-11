<?php 
    class atividadeDAO
    {
        private $db;

        public function __construct()
        {
            $this->db = Conexao::getInstancia();
        }

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

        public function cadastrar_atividade(Atividade $atividade){
			$sql = 
			"INSERT 
			INTO atividades (id_workspace_fk, nome_atividade, descricao_atividade, data_entrega, data_criacao) 
			VALUES (:id_workspace_fk, :nome_atividade, :descricao_atividade, :data_entrega, :data_criacao)"; 

			try
			{
				$stm = $this->db->prepare($sql);
				$stm->execute([
					"id_workspace_fk" => $atividade->getId(),
					"nome_atividade" => $atividade->getNome(),
					"descricao_atividade" => $atividade->getDescricao(),
					"data_entrega" => $atividade->getDataEntrega(),
					"data_criacao" => $atividade->getDataCriacao()
				]);
				$this->db = null;
				return;
			}
			catch(PDOException $e)
			{
				$this->db = null;
				die("Problema ao buscar as atividades");
			}
			
        }

        public function buscar_uma_atividade(Atividade $atividade)
		{
			$sql = "SELECT * FROM atividade WHERE idAtividade = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $atividade->getId());
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