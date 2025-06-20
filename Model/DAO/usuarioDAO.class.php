<?php
class usuarioDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Conexao::getInstancia();
    }

    public function buscar_usuarios()
    {
        $sql = "SELECT * FROM usuario";
        try 
        {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } 
        catch (PDOException $e) 
        {
            $this->db = null;
            die("Erro ao buscar atividade: " . $e->getMessage());
        }
    }

    public function buscar_um_usuario(Usuario $usuario): mixed
    {
        $sql = "SELECT * FROM usuario WHERE id_usuario = :id OR email_usuario = :email LIMIT 1";
        try 
        {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                "id" => $usuario->getId(),
                "email" => $usuario->getEmail()
            ]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } 
        catch (PDOException $e) 
        {
            $this->db = null;
            die("Erro ao buscar atividade: " . $e->getMessage());
        }
    }

    public function buscar_emails(Usuario $usuario) 
    {
        $sql = "SELECT id_usuario, email_usuario, avatar_usuario FROM usuario WHERE email_usuario LIKE CONCAT(:substr, '%') ;";
        try 
        {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                "substr" => $usuario->getEmail()
            ]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        catch (PDOException $e) 
        {
            $this->db = null;
            die("Não foi possível buscar usuários: " . $e->getMessage());
        }
    }

    public function cadastrar_usuario(Usuario $usuario)
    {
        $sql = "INSERT 
        INTO usuario (nome_usuario, email_usuario, senha_usuario) 
        VALUES (:nome, :email, :senha);";

        try 
        {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                "nome" => $usuario->getNome(),
                "email" => $usuario->getEmail(),
                "senha" => $usuario->getSenha()
            ]);
        } 
        catch (PDOException $e) 
        {
            $this->db = null;
            var_dump($e->getMessage());
			die("Erro ao cadastrar usuário: " . $e->getMessage());
        }
    }
}

?>