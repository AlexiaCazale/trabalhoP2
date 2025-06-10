<?php
    class Comentario {
        public function __construct(
            private int $idComentario = 0,
            private string $texto = "",
            private Usuario $usuario
        ) {}

        public function getIdComentario() 
        {
            return $this->idComentario;
        }
        public function setIdComentario(int $id)
        {
            $this->idComentario = $id;
        }
        public function getTexto() 
        {
            return $this->texto;
        }
        public function setTexto(string $texto)
        {
            $this->texto = $texto;
        }
        public function getUsuario() 
        {
            return $this->usuario;
        }
        public function setUsuario(Usuario $usuario)
        {
            $this->usuario = $usuario;
        }
    }
?>