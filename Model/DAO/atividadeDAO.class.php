<?php
class atividadeDAO
{

	# TODO Adicionar usuários a uma atividade
	# TODO Remover usuário 
	# TODO Alterar dados da atividade 
	# TODO Desativar a atividade
	# TODO Buscar comentários
	# TODO Excluir comentários

	public ?PDO $db;

	public function __construct()
	{
		$this->db = Conexao::getInstancia();
	}

	public function cadastrar_atividade(Atividade $atividade)
	{
		$sql = "INSERT 
			INTO atividade (id_workspace_fk, nome_atividade, descricao_atividade, data_entrega_atividade) 
			VALUES (:id_workspace_fk, :nome_atividade, :descricao_atividade, :data_entrega)";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute(
				[
					"id_workspace_fk" => $atividade->getWorkspace()->getId(),
					"nome_atividade" => $atividade->getNome(),
					"descricao_atividade" => $atividade->getDescricao(),
					"data_entrega" => $atividade->getDataEntrega()
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

	public function cadastrar_usuario_em_atividade(Atividade $atividade, Usuario $usuario) {
		$sql = "INSERT INTO membro_atividade (id_usuario_fk, id_atividade_fk) 
				VALUES (:id_usuario, :id_atividade)";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				"id_usuario" => $usuario->getId(),
				"id_atividade" => $atividade->getId()
			]);
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			$this->db = null;
			die("Problema ao cadastrar usuário na atividade: " . $e->getMessage());
		}
	}
}
?>