<?php

namespace dao;

use model\Professor;

class ProfessorDAO
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
            self::$model = new ProfessorDAO($conexao);
        endif;
        return self::$model;
    }

    public function adicionar(Professor $professor)
    {
        try {
            $sql = "INSERT into Professor (nomeProfessor) VALUES (?)";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $professor->getNomeProfessor());
            $stm->execute();
            $result = $this->pdo->lastInsertId();
            $professor->setIdProfessor($result);
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }


    public function alterar(Professor $professor)
    {
        try {
            $sql = "UPDATE Professor set nomeProfessor = ? where idProfessor = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $professor->getNomeProfessor());
            $stm->bindValue(2, $professor->getIdProfessor());
            $stm->execute();
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function carregar($id)
    {
        try {
            $sql = "SELECT * from Professor where idProfessor = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->setFetchMode(\PDO::FETCH_CLASS, 'model\Professor');
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
            $sql = "DELETE from Professor where idProfessor = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->execute();
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getProfessores()
    {
        try {
            $sql = "SELECT * from Professor order by nomeProfessor;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_CLASS, 'model\Professor');
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }



    public function getTopFive()
    {
        try {
            $sql = "SELECT * from Professor inner join Projeto using (idProfessor) order by nomeProfessor limit 5";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_CLASS, 'model\Professor');
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getCount()
    {
        try{
            $sql = "SELECT count(*) from Professor";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchColumn();
            return $result;
        }catch(\PDOException $ex){
            throw $ex;
        }
    }

}