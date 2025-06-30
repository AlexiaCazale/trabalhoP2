<?php
class workspaceDAO
{
	# TODO Desativar workspace
	# TODO Adicionar usuário ao workspace 
	# TODO Remover usuário 
	# TODO Alterar dados do workspace

	private $db;

	public function __construct()
	{
		$this->db = Conexao::getInstancia();
	}

	public function buscarWorkspaces(): array
	{
		$sql = "SELECT * FROM workspace WHERE ativo_workspace";
		$stm = $this->db->prepare($sql);
		$stm->execute();
		$this->db = null;
		return $stm->fetchAll(PDO::FETCH_ASSOC);
	}

	public function buscarUmWorkspace(Workspace $workspace)
	{
		$sql = "SELECT * FROM workspace WHERE id_workspace = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(['id' => $workspace->getId()]);
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function buscarAdminDoWorkspace(Workspace $workspace)
	{
		$sql =
			"SELECT u.* FROM workspace w
		JOIN usuario u ON w.id_usuario_admin_fk = u.id_usuario
		WHERE w.id_workspace = :id;";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id" => $workspace->getId()
		]);
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function cadastrarWorkspace(Workspace $workspace): void
	{
		$sql =
			"INSERT 
			INTO workspace (nome_workspace, descricao_workspace, id_usuario_admin_fk) 
			VALUES (:nome, :descricao, :id_usuario)";

		$stm = $this->db->prepare($sql);
		$stm->execute([
			"nome" => $workspace->getNome(),
			"descricao" => $workspace->getDescricao(),
			"id_usuario" => $workspace->getUsuarios()[0]->getId()
		]);
	}

	public function alterarWorkspace(Workspace $workspace)
	{
		$sql =
			"UPDATE workspace w 
		SET nome_workspace = :nome, descricao_workspace = :descricao, ativo_workspace = :ativo
		WHERE w.id_workspace = :id";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"nome" => $workspace->getNome(),
			"descricao" => $workspace->getDescricao(),
			"ativo" => $workspace->getAtivo(),
			"id" => $workspace->getId()
		]);
	}

	public function buscarWorkspacesInativosDoAdmin(Usuario $usuario): array
	{
		$sql = "SELECT * FROM workspace WHERE id_usuario_admin_fk = :id_admin AND ativo_workspace = 0";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(['id_admin' => $usuario->getId()]);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function alterarAtivoWorkspace(Workspace $workspace)
	{
		// Esta query alterna o valor de ativo_workspace (de 0 para 1, e de 1 para 0)
		$sql = "UPDATE workspace SET ativo_workspace = !ativo_workspace WHERE id_workspace = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(['id' => $workspace->getId()]);
	}

	public function usuarioEstaNoWorkspace(Workspace $workspace, Usuario $usuario)
	{
		$sql = "SELECT * FROM workspace w 
				JOIN membro_workspace mw ON w.id_workspace = mw.id_workspace_fk
				JOIN usuario u ON mw.id_usuario_fk = u.id_usuario 
				WHERE u.id_usuario = :id_usuario and w.id_workspace = :id_workspace AND u.ativo_usuario;";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id_usuario" => $usuario->getId(),
			"id_workspace" => $workspace->getId()
		]);
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);

		return count($result) !== 0;
	}

	public function buscarUsuariosDoWorkspace(Workspace $workspace)
	{
		$sql = "SELECT u.id_usuario, u.nome_usuario, u.email_usuario, u.avatar_usuario FROM workspace w 
				JOIN membro_workspace mw ON w.id_workspace = mw.id_workspace_fk
				JOIN usuario u ON mw.id_usuario_fk = u.id_usuario
				WHERE w.id_workspace = :id AND u.ativo_usuario;";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id" => $workspace->getId()
		]);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function cadastrarUsuarioNoWorkspace(Workspace $workspace, Usuario $usuario)
	{
		$sql = "INSERT INTO membro_workspace (id_workspace_fk, id_usuario_fk) 
				VALUES (:id_workspace, :id_usuario)";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id_workspace" => $workspace->getId(),
			"id_usuario" => $usuario->getId()
		]);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function removerUsuarioDoWorkspace(Workspace $workspace, Usuario $usuario)
	{
		$sql =
			"DELETE FROM membro_workspace
    WHERE id_workspace_fk = :id_workspace AND id_usuario_fk = :id_usuario;";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id_workspace" => $workspace->getId(),
			"id_usuario" => $usuario->getId()
		]);
	}

	public function removerUsuarioDeTodasAtividadesNoWorkspace(Workspace $workspace, Usuario $usuario)
	{
		$sql = "
        DELETE ma
        FROM membro_atividade ma
        JOIN atividade a ON ma.id_atividade_fk = a.id_atividade
        WHERE ma.id_usuario_fk = :id_usuario
          AND a.id_workspace_fk = :id_workspace;
    ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			'id_usuario' => $usuario->getId(),
			'id_workspace' => $workspace->getId(),
		]);
	}

	public function buscarAtividadesDoWorkspace(Workspace $workspace)
	{
		$sql = "SELECT a.* FROM atividade a
				JOIN workspace w ON a.id_workspace_fk = w.id_workspace
				WHERE w.id_workspace = :id AND a.ativo_atividade;";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id" => $workspace->getId()
		]);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function buscarUltimoId()
	{
		return $this->db->lastInsertId();
	}
}
