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

	public function cadastrarAtividade(Atividade $atividade)
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

	public function alterarAtividade(Atividade $atividade) 
	{
		$sql = 
		"UPDATE atividade 
		SET (
			nome_workspace = :nome, 
			descricao_atividade = :descricao,  
			data_entrega_atividade = :data_entrega, 
			data_criacao_atividade = :data_criacao, 
			ativo_atividade = :ativo, 
			concluido_atividade = :concluido, 
			data_concluido_atividade = :data_concluido
		)";

		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				"nome" => $atividade->getNome(),
				"descricao" => $atividade->getDescricao(),
				"data_entrega" => $atividade->getDataEntrega(),
				"data_criacao" => $atividade->getDataCriacao(),
				"ativo" => $atividade->getAtivo(),
				"concluido" => $atividade->getConcluido(),
				"data_concluido" => $atividade->getConcluido()
			]);
		} catch (PDOException $e) {
			$this->db = null;
			die("Erro ao atualizar os dados da atividade: " + $e->getMessage());
		}
	}

	public function removerAtividade(Atividade $atividade) 
	{
		$sql = 
		"DELETE FROM atividade a
		WHERE a.id_atividade = :id_atividade";

		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				"id_atividade" => $atividade->getId()
			]);
		} catch (PDOException $e) {
			$this->db = null;
			die("Erro ao deletar a atividade: " + $e->getMessage());
		}
	}

	public function buscarUmaAtividade(Atividade $atividade)
	{
		$sql = "SELECT * FROM atividade WHERE id_atividade = :id";
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
	
	public function usuarioEstaNaAtividade(Atividade $atividade, Usuario $usuario)
	{
		$sql = "SELECT * FROM atividade a 
				JOIN membro_atividade ma ON a.id_atividade = ma.id_atividade_fk
				JOIN usuario u ON ma.id_usuario_fk = u.id_usuario 
				WHERE u.id_usuario = :id_usuario and a.id_atividade = :id_atividade;";

		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				"id_usuario" => $usuario->getId(),
				"id_atividade" => $atividade->getId()
			]);
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);

			return count($result) !== 0;
		} catch (PDOException $e) {
			$this->db = null;
			die("Problema ao buscar um usuário: " . $e->getMessage());
		}
	}

	public function buscarUsuariosEmAtividade(Atividade $atividade) {
		return $atividade;
	}

	public function cadastrarUsuarioNaAtividade(Atividade $atividade, Usuario $usuario) {
		$sql = 
		"INSERT INTO membro_atividade (id_usuario_fk, id_atividade_fk)
		SELECT :id_usuario, :id_atividade
		FROM DUAL
		WHERE EXISTS (
		    SELECT 1
		    FROM membro_workspace mw
		    JOIN atividade a ON mw.id_workspace_fk = a.id_workspace_fk
		    WHERE mw.id_usuario_fk = :id_usuario
		      AND a.id_atividade = :id_atividade);";
		
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