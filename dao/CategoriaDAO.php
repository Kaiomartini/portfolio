<?php

namespace dao;

use model\Categoria;

class CategoriaDAO
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
            self::$model = new CategoriaDAO($conexao);
        endif;
        return self::$model;
    }

    public function adicionar(Categoria $categoria)
    {
        try {
            $sql = "INSERT into Categoria (nomeCategoria) VALUES (?)";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $categoria->getNomeCategoria());
            $stm->execute();
            $result = $this->pdo->lastInsertId();
            $categoria->setIdCategoria($result);
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function alterar(Categoria $categoria)
    {
        try {
            $sql = "UPDATE Categoria set nomeCategoria = ? where idCategoria = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $categoria->getNomeCategoria());
            $stm->bindValue(2, $categoria->getIdCategoria());
            $stm->execute();
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function carregar($id)
    {
        try {
            $sql = "SELECT * from Categoria where idCategoria = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->setFetchMode(\PDO::FETCH_CLASS, 'model\Categoria');
            $stm->execute();
            $result = $stm->fetch();
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function excluir($id)
    {
        try {
            $sql = "DELETE from Categoria where idCategoria = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->execute();
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getCategorias()
    {
        try {
            $sql = "SELECT * from Categoria order by nomeCategoria;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_CLASS, 'model\Categoria');
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getTopFive()
    {
        try {
            $sql = "SELECT * from Categoria inner join Projeto using (idCategoria) order by nomeCategoria limit 5";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_CLASS, 'model\Categoria');
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getCount()
    {
        try {
            $sql = "SELECT count(*) from Categoria";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchColumn();
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

}