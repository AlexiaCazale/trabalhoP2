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
                $stm = $this->db->prepare($sql);
                $stm->execute();
                $this->db = null;
                return $stm->fetchAll(PDO::FETCH_OBJ);

            }catch(PDOException $e){
                $this->db = null;
                $_SESSION['mensagem'] = 'Erro ao buscar usuários';
                die("Problema ao buscar os usuários");
            }
        }

        public function buscar_um_usuario(Usuario $usuario) 
        {
            $sql = "SELECT * FROM usuario WHERE id_usuario = :id OR email_usuario = :email";
            try 
            {
                $stm = $this->db->prepare($sql);
                $stm->execute([
                    "id" => $usuario->getId(),
                    "email" => $usuario->getEmail()
                ]);
                $this->db = null;
                return $stm->fetchAll(PDO::FETCH_OBJ)[0];
            }
            catch (PDOException $e)
            {
                $this->db = null;
                die("Problema ao buscar um usuário");
            }
        }

        public function cadastrar_usuario(Usuario $usuario){
			$sql = "INSERT 
			INTO usuario (nome_usuario, email_usuario, senha_usuario) 
			VALUES (:nome, :email, :senha);";

			try
			{
				$stm = $this->db->prepare($sql);
				$stm->execute([
                    "nome" => $usuario->getNome(),
                    "email" => $usuario->getEmail(),
                    "senha" => $usuario->getSenha()
                ]);
				$this->db = null;
			}
			catch(PDOException $e)
			{
				$this->db = null;
				die("Problema ao cadastrar um usuário");
			}
        }
    }

?>