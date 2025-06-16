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
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $this->db = null;
            die("Erro ao buscar atividade");
        }
    }

    public function buscar_um_usuario(Usuario $usuario)
    {
        $sql = "SELECT * FROM usuario WHERE id_usuario = :id OR email_usuario = :email";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                "id" => $usuario->getId(),
                "email" => $usuario->getEmail()
            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->db = null;
            die("Erro ao buscar atividade");
        }
    }

    public function cadastrar_usuario(Usuario $usuario)
    {
        $sql = "INSERT 
        INTO usuario (nome_usuario, email_usuario, senha_usuario) 
        VALUES (:nome, :email, :senha);";

        
    }
}

?>