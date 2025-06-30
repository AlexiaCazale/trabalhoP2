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
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id_workspace_fk" => $atividade->getWorkspace()->getId(),
			"nome_atividade" => $atividade->getNome(),
			"descricao_atividade" => $atividade->getDescricao(),
			"data_entrega" => $atividade->getDataEntrega()->format('Y-m-d H:i:s')  // apenas esta
		]);
	}


	public function alterarAtividade(Atividade $atividade)
	{
		$sql =
			"UPDATE atividade 
			SET nome_atividade = :nome, descricao_atividade = :descricao, data_entrega_atividade = :data_entrega
			WHERE id_atividade = :id";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"nome" => $atividade->getNome(),
			"descricao" => $atividade->getDescricao(),
			"data_entrega" => $atividade->getDataEntrega()->format('Y-m-d H:i:s'),
			"id" => $atividade->getId()
		]);
	}

	public function desativarAtividade(Atividade $atividade)
	{
		$sql =
			"UPDATE atividade a 
			SET a.ativo_atividade = false
			WHERE a.id_atividade = :id_atividade";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id_atividade" => $atividade->getId()
		]);
	}

	public function alterarConcluidoAtividade(Atividade $atividade)
	{
		$sql = 
		"UPDATE atividade 
		SET concluido_atividade = !concluido_atividade, data_concluido_atividade = :data_atual
		WHERE id_atividade = :id";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id" => $atividade->getId(),
			"data_atual" => date("Y-m-d H:i:s", (time() - 18000)) // Subtrai 5 horas para acertar o fuso
		]);
	}

	public function buscarUmaAtividade(Atividade $atividade)
	{
		$sql = "SELECT * FROM atividade WHERE id_atividade = :id and atividade.ativo_atividade";
		$stm = $this->db->prepare($sql);
		$stm->execute(["id" => $atividade->getId()]);
		return $stm->fetch(PDO::FETCH_OBJ);
	}

	public function usuarioEstaNaAtividade(Atividade $atividade, Usuario $usuario)
	{
		$sql = "SELECT * FROM atividade a 
				JOIN membro_atividade ma ON a.id_atividade = ma.id_atividade_fk
				JOIN usuario u ON ma.id_usuario_fk = u.id_usuario 
				WHERE u.id_usuario = :id_usuario and a.id_atividade = :id_atividade and u.ativo_usuario;";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id_usuario" => $usuario->getId(),
			"id_atividade" => $atividade->getId()
		]);
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

		return count($result) !== 0;
	}

	public function buscarUsuariosEmAtividade(Atividade $atividade)
	{
		$sql =
			"SELECT u.* FROM atividade a
			JOIN membro_atividade ma ON a.id_atividade = ma.id_atividade_fk
			JOIN usuario u ON ma.id_usuario_fk = u.id_usuario
			WHERE a.id_atividade = :id and u.ativo_usuario";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id" => $atividade->getId()
		]);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function buscarWorkspaceDaAtividade(Atividade $atividade)
	{
		$sql =
			"SELECT w.* FROM atividade a
			JOIN workspace w ON a.id_workspace_fk = w.id_workspace
			WHERE a.id_atividade = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id" => $atividade->getId()
		]);
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function cadastrarUsuarioNaAtividade(Atividade $atividade, Usuario $usuario)
	{
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

		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id_usuario" => $usuario->getId(),
			"id_atividade" => $atividade->getId()
		]);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function removerUsuarioDaAtividade(Atividade $atividade, Usuario $usuario) 
	{
		$sql = 
		"DELETE FROM membro_atividade WHERE id_usuario_fk = :id_usuario AND id_atividade_fk = :id_atividade;";
		
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id_usuario" => $usuario->getId(),
			"id_atividade" => $atividade->getId()
		]);
	}
}
