<?php
    class Workspace 
    {
        public function __construct(private int $idWorkspace = 0, private string $nome = "", private string $descricao = ""){}

        // TODO: Adicionar membros -> não obrigatório?

        public function getIdWorkspace(){
            return $this -> idWorkspace;
        }
        public function getNome(){ 
            return $this -> nome;
        }
        public function getDescricao(){
            return $this -> descricao;
        }
    }

?>