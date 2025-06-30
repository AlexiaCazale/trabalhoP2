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
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function buscarUmUsuario(Usuario $usuario): mixed
	{
		$sql = "SELECT * FROM usuario WHERE (id_usuario = :id OR email_usuario = :email) AND ativo_usuario LIMIT 1";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id" => $usuario->getId(),
			"email" => $usuario->getEmail()
		]);
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function buscarEmails(Usuario $usuario)
	{
		$sql = "SELECT id_usuario, email_usuario, avatar_usuario FROM usuario WHERE email_usuario LIKE CONCAT(:substr, '%') AND ativo_usuario ;";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"substr" => $usuario->getEmail()
		]);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function buscarWorkspaces(Usuario $usuario)
	{
		$sql = "SELECT w.* 
        FROM workspace w 
        JOIN membro_workspace mw ON w.id_workspace = mw.id_workspace_fk 
        JOIN usuario u ON mw.id_usuario_fk = u.id_usuario 
        WHERE u.id_usuario = :id and w.ativo_workspace";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"id" => $usuario->getId()
		]);
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function cadastrarUsuario(Usuario $usuario)
	{
		$sql = "INSERT 
        INTO usuario (nome_usuario, email_usuario, senha_usuario) 
        VALUES (:nome, :email, :senha);";

		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			"nome" => $usuario->getNome(),
			"email" => $usuario->getEmail(),
			"senha" => $usuario->getSenha()
		]);
	}
}

?>