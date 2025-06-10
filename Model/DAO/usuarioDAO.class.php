<?php 
    class usuarioDAO
    {
        public function __construct(private $db = null){}

        public function buscar_usuarios() 
        {
            $sql = "SELECT * FROM usuario";
            try 
            {
                $stm = $this -> db -> prepare($sql);
                $stm -> execute();
                $this -> db = null;

                $_SESSION['mensagem'] = 'Usuários buscados com sucesso!';
                // header('Location: /index.php');

            }catch(PDOException $e){
                $this -> db = null;
                echo $e -> getMessage();
                echo $e -> getCode();
                $_SESSION['mensagem'] = 'Erro ao buscar usuários';
                die();
            }
        }

        public function cadastrar_usuario($usuario)
        {
            $sql = "INSERT INTO usuario (nome, email, senha) VALUES(?, ?, ?)";
            try{
                $stm = $this -> db -> prepare($sql);
                $stm -> bindValue(1, $usuario -> getNome());
                $stm -> bindValue(2, $usuario -> getEmail());
                $stm -> bindValue(3, $usuario -> getSenha());

                $stm -> execute();
                $this -> db = null;

                $_SESSION['mensagem'] = 'Usuário cadastrado com sucesso!';
                // header('Location: /index.php');

            }catch(PDOException $e){
                $this -> db = null;
                echo $e -> getMessage();
                echo $e -> getCode();
                $_SESSION['mensagem'] = 'Erro ao registrar: ' . htmlspecialchars($e -> getMessage());
                die();
            }
        }

        public function login_usuario($usuario)
        {
            $sql = "SELECT * FROM usuario WHERE email = ? AND senha = ?";

			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $usuario -> getEmail());
				$stm->bindValue(2, $usuario -> getSenha());
				$stm->execute();
				$this->db = null;
				return $stm->fetchAll(PDO::FETCH_OBJ);
			}
			catch(PDOException $e)
			{
				$this->db = null;
				echo $e->getMessage();
				echo $e->getCode();
				die();
			}
        }
    }

?>