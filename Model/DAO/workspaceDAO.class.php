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

	public function get_db()
	{
		return $this->db;
	}

	public function buscar_workspaces(): array
	{
		$sql = "SELECT * FROM workspace";
		try {
			$stm = $this->db->prepare($sql);
			$stm->execute();
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			$this->db = null;
			die("Problema ao buscar os workspaces: " . $e->getMessage());
		}
	}

	public function buscar_um_workspace(Workspace $workspace): mixed
	{
		$sql = "SELECT * FROM workspace WHERE id_workspace = :id_workspace";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				"id_workspace" => $workspace->getId()
			]);
			return $stmt->fetch(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			$this->db = null;
			die("Problema ao buscar um workspace:" . $e->getMessage());
		}
	}

	public function cadastrar_workspace(Workspace $workspace): void
	{
		$sql =
			"INSERT 
			INTO workspace (nome_workspace, descricao_workspace) 
			VALUES (:nome, :descricao)";

		try {
			$stm = $this->db->prepare($sql);
			$stm->execute([
				"nome" => $workspace->getNome(),
				"descricao" => $workspace->getDescricao()
			]);
			$this->db = null;
			return;
		} catch (PDOException $e) {
			$this->db = null;
			die("Problema ao cadastrar um workspace: " . $e->getMessage());
		}
	}

	public function buscar_usuarios_do_workspace(Workspace $workspace)
	{
		$sql = "SELECT u.id_usuario, u.nome_usuario, u.email_usuario, u.avatar_usuario FROM workspace w 
				JOIN membro_workspace mw ON w.id_workspace = mw.id_workspace_fk
				JOIN usuario u ON mw.id_usuario_fk = u.id_usuario
				WHERE w.id_workspace = :id AND u.ativo_usuario;";

		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				"id" => $workspace->getId()
			]);
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			$this->db = null;
			die("Problema ao cadastrar um workspace: " . $e->getMessage());
		}
	}

	public function cadastrar_usuario_ao_workspace(Workspace $workspace, Usuario $usuario)
	{
		$sql = "INSERT INTO membro_workspace (id_workspace_fk, id_usuario_fk) 
				VALUES (:id_workspace, :id_usuario)";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				"id_workspace" => $workspace->getId(),
				"id_usuario" => $usuario->getId()
			]);
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			$this->db = null;
			die("Problema ao cadastrar o usuário no workspace: " . $e->getMessage());
		}
	}

	public function buscar_atividades_do_workspace(Workspace $workspace)
	{
		$sql = "SELECT a.* FROM atividade a
				JOIN workspace w ON a.id_workspace_fk = w.id_workspace
				WHERE w.id_workspace = :id;";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				"id" => $workspace->getId()
			]);
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			$this->db = null;
			die("Problema ao buscar as atividades: " . $e->getMessage());
		}
	}
}
?>