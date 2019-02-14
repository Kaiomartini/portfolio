<?php

namespace dao;

use model\Materia;

class MateriaDAO
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
            self::$model = new MateriaDAO($conexao);
        endif;
        return self::$model;
    }

    public function adicionar(Materia $materia)
    {
        try {
            $sql = "INSERT into Materia (nomeMateria) VALUES (?)";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $materia->getNomeMateria());
            $stm->execute();
            $result = $this->pdo->lastInsertId();
            $materia->setIdMateria($result);
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }


    public function alterar(Materia $materia)
    {
        try {
            $sql = "UPDATE Materia set nomeMateria = ? where idMateria = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $materia->getNomeMateria());
            $stm->bindValue(2, $materia->getIdMateria());
            $stm->execute();
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function carregar($id)
    {
        try {
            $sql = "SELECT * from Materia where idMateria = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->setFetchMode(\PDO::FETCH_CLASS, 'model\Materia');
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
            $sql = "DELETE from Materia where idMateria = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->execute();
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getMaterias()
    {
        try {
            $sql = "SELECT * from Materia order by nomeMateria;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_CLASS, 'model\Materia');
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getTopFive()
    {
        try {
            $sql = "SELECT * from Materia inner join Projeto using (idMateria) order by nomeMateria limit 5";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_CLASS, 'model\Materia');
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getCount()
    {
        try {
            $sql = "SELECT count(*) from Materia";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchColumn();
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

}