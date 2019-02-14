<?php
namespace model;

class Usuario{
    private $idUsuario;
    private $nomeUsuario;
    private $senha;

    public function __construct()
    {
    }
    public function getIdUsuario(){
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    public function getNomeUsuario(){
        return $this->nomeUsuario;
    }
    public function setNomeUsuario($nomeUsuario){
        $this->nomeUsuario;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }
}