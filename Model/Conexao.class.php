<?php
//singleton
class Conexao
{
	private static $conexao;
	private function __construct()
	{
	}
	public static function getInstancia()
	{
		if (empty(self::$conexao)) {
			$parametros = "mysql:host=localhost;dbname=task_hub;charset=utf8mb4";
			try {
				self::$conexao = new PDO($parametros, "root", "root");
			} catch (PDOException $e) {
				echo $e->getCode();
				echo $e->getMessage();
				echo "Problema na conexão";
				die();
			}
		}
		return self::$conexao;
	}
}
?>