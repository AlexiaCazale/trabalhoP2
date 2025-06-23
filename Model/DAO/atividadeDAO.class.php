<?php
class atividadeDAO
{

	# TODO Adicionar usuários a uma atividade, remover usuário, alterar dados da atividade, desativar a atividade, buscar comentários e excluir comentários

	public ?PDO $db;

	public function buscar_atividades()
	{
		$this->db = Conexao::getInstancia();
	}

	public function cadastrar_atividade(Atividade $atividade)
	{
		$sql = "INSERT 
			INTO atividades (id_workspace_fk, nome_atividade, descricao_atividade, data_entrega, data_criacao) 
			VALUES (:id_workspace_fk, :nome_atividade, :descricao_atividade, :data_entrega, :data_criacao)";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute(
				[
					"id_workspace_fk" => $atividade->getWorkspace()->getId(),
					"nome_atividade" => $atividade->getNome(),
					"descricao_atividade" => $atividade->getDescricao(),
					"data_entrega" => $atividade->getDataEntrega(),
					"data_criacao" => $atividade->getDataCriacao()
				]
			);
		} catch (PDOException $e) {
			$this->db = null;
			die("Erro ao cadastrar atividade:" . $e->getMessage());
		}
	}

	public function buscar_uma_atividade(Atividade $atividade)
	{
		$sql = "SELECT * FROM atividade WHERE idAtividade = :id";
		try {
			$stm = $this->db->prepare($sql);
			$stm->execute(["id" => $atividade->getId()]);
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			$this->db = null;
			die("Erro ao buscar atividade:" . $e->getMessage());
		}
	}
}
?>