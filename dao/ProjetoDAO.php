<?php

namespace dao;

use model\Categoria;
use model\Projeto;

class ProjetoDAO
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
            self::$model = new ProjetoDAO($conexao);
        endif;
        return self::$model;
    }

    public function adicionar(Projeto $projeto)
    {
        try {
            $sql = "INSERT into Projeto (nomeProjeto, imagemProjeto, idCategoria, idSemestre, idMateria, idProfessor) VALUES (?, ?, ? ,? ,? ,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $projeto->getNomeProjeto());
            $stm->bindValue(2, $projeto->getImagemProjeto());
            $stm->bindValue(3, $projeto->getIdCategoria());
            $stm->bindValue(4, $projeto->getIdSemestre());
            $stm->bindValue(5, $projeto->getIdMateria());
            $stm->bindValue(6, $projeto->getIdProfessor());
            $stm->execute();
            $result = $this->pdo->lastInsertId();
            $projeto->setIdProjeto($result);
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function alterar(Projeto $projeto)
    {
        try {
            $sql = "UPDATE Projeto set nomeProjeto = ?, imagemProjeto = ?, idCategoria = ?, idSemestre = ?, idMateria = ?, idProfessor = ? where idProjeto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $projeto->getNomeProjeto());
            $stm->bindValue(2, $projeto->getImagemProjeto());
            $stm->bindValue(3, $projeto->getIdCategoria());
            $stm->bindValue(4, $projeto->getIdSemestre());
            $stm->bindValue(5, $projeto->getIdMateria());
            $stm->bindValue(6, $projeto->getIdProfessor());
            $stm->bindValue(7, $projeto->getIdProjeto());
            $stm->execute();
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function carregar($id)
    {
        try {
            $sql = "SELECT * from Projeto where idProjeto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->setFetchMode(\PDO::FETCH_CLASS, 'model\Projeto');
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
            $sql = "DELETE from Projeto where idProjeto = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->execute();
            return true;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getProjetos()
    {
        try {
            $sql = "SELECT * from Projeto order by idProjeto";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_CLASS, 'model\Projeto');
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getTopFiveByCategory(Categoria $categoria)
    {
        try {
            $sql = "SELECT * from Projeto where idCategoria = ? order by nomeProjeto limit 5";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(1, $categoria->getIdCategoria());
            $stm->execute();
            $result = $stm->fetchAll(\PDO::FETCH_CLASS, 'model\Projeto');
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getCount()
    {
        try {
            $sql = "SELECT count(*) from Projeto";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchColumn();
            return $result;
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

}