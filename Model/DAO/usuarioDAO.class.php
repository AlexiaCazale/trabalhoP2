<?php
class usuarioDAO
{
	# TODO Buscar atividades de um usuário 
	# TODO Alterar dados do usuário 
	# TODO Inativar o usuário 
	# TODO Remover comentário

	private $db;

	public function __construct()
	{
		$this->db = Conexao::getInstancia();
	}

	public function buscarUsuarios()
	{
		$sql = "SELECT * FROM usuario WHERE ativo_usuario"; // Adicionar um LIMIT e OFFSET; Criar uma classe para fazer a paginação?
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			$this->db = null;
			die("Erro ao buscar atividade: " . $e->getMessage());
		}
	}

	public function buscarUmUsuario(Usuario $usuario): mixed
	{
		$sql = "SELECT * FROM usuario WHERE (id_usuario = :id OR email_usuario = :email) AND ativo_usuario LIMIT 1";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				"id" => $usuario->getId(),
				"email" => $usuario->getEmail()
			]);
			return $stmt->fetchAll(PDO::FETCH_OBJ)[0];
		} catch (PDOException $e) {
			$this->db = null;
			die("Erro ao buscar atividade: " . $e->getMessage());
		}
	}

	public function buscarEmails(Usuario $usuario)
	{
		$sql = "SELECT id_usuario, email_usuario, avatar_usuario FROM usuario WHERE email_usuario LIKE CONCAT(:substr, '%') AND ativo_usuario ;";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				"substr" => $usuario->getEmail()
			]);
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			$this->db = null;
			die("Não foi possível buscar usuários: " . $e->getMessage());
		}
	}

	public function buscarWorkspaces(Usuario $usuario)
	{
		$sql = "SELECT w.* 
        FROM workspace w 
        JOIN membro_workspace mw ON w.id_workspace = mw.id_workspace_fk 
        JOIN usuario u ON mw.id_usuario_fk = u.id_usuario 
        WHERE u.id_usuario = :id and w.ativo_workspace";

		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				"id" => $usuario->getId()
			]);
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			$this->db = null;
			die("Erro ao cadastrar usuário: " . $e->getMessage());
		}
	}

	public function cadastrarUsuario(Usuario $usuario)
	{
		$sql = "INSERT 
        INTO usuario (nome_usuario, email_usuario, senha_usuario) 
        VALUES (:nome, :email, :senha);";

		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				"nome" => $usuario->getNome(),
				"email" => $usuario->getEmail(),
				"senha" => $usuario->getSenha()
			]);
		} catch (PDOException $e) {
			$this->db = null;
			die("Erro ao cadastrar usuário: " . $e->getMessage());
		}
	}
}

?>