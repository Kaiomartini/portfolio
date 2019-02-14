<?php

namespace dao;

use model\Semestre;

class SemestreDAO
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
            self::$model = new SemestreDAO($conexao);
        endif;
        return self::$model;
    }

    public function adicionar(Semestre $semestre)
    {
        try {
            $sql = "INSERT into Semestre (nomeSemestre) VALUES (?)";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $semestre->getNomeSemestre());
            $stm->execute();
            $result = $this->pdo->lastInsertId();
            $semestre->setIdSemestre($result);
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function alterar(Semestre $semestre)
    {
        try {
            $sql = "UPDATE Semestre set nomeSemestre = ? where idSemestre = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $semestre->getNomeSemestre());
            $stm->bindValue(2, $semestre->getIdSemestre());
            $stm->execute();
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function carregar($id)
    {
        try {
            $sql = "SELECT * from Semestre where idSemestre = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->setFetchMode(\PDO::FETCH_CLASS, 'model\Semestre');
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
            $sql = "DELETE from Semestre where idSemestre = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->execute();
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getSemestres()
    {
        try {
            $sql = "SELECT * from Semestre order by nomeSemestre;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_CLASS, 'model\Semestre');
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }


    public function getTopFive()
    {
        try {
            $sql = "SELECT * from Semestre inner join Projeto using (idSemestre) order by nomeSemestre limit 5";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_CLASS, 'model\Semestre');
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getCount()
    {
        try {
            $sql = "SELECT count(*) from Semestre";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchColumn();
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

}