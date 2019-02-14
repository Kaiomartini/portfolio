<?php

namespace dao;

use model\Usuario;

class UsuarioDAO
{
    private static $model = null;
    private $pdo = null;

    private function __construct($conexao)
    {
        $this->pdo = $conexao;
    }

    public static function getInstance($conexao)
    {
        if (!isset(self::$model)):
            self::$model = new usuarioDAO($conexao);
        endif;
        return self::$model;
    }
    public function adicionar(Usuario $usuario)
    {
        try {
            $sql = "INSERT into usuario (nomeUsuario,senha) VALUES (?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $usuario->getNomeUsuario());
            $stm->bindValue(2, $usuario->getsenha());
            $stm->execute();
            $result = $this->pdo->lastInsertId();
            $usuario->setIdUsuario($result);
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }
    
    public function carregar($idUsuario)
    {
        try {
            $sql = "SELECT * from usuario where idUsuario = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $idUsuario);
            $stm->setFetchMode(\PDO::FETCH_CLASS, 'model\Usuario');
            $stm->execute();
            $result = $stm->fetch();
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }
}