<?php

namespace controller;

use dao\ProfessorDAO;
use model\Professor;
use util\ConnectionFactory;

class ProfessorController
{
    function __construct()
    {
        $this->professorDAO = ProfessorDAO::getInstance(ConnectionFactory::getInstance());
    }

    public function adicionar(Professor $professor)
    {
        try {
            if (empty($professor->getNomeProfessor())) {
                throw new \Exception("O Nome informado é inválido.");
            } else if (strlen($professor->getNomeProfessor()) > 255) {
                throw new \Exception("O Nome excede o limite de caracteres.");
            }else {
                return $this->professorDAO->adicionar($professor);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function alterar(Professor $professor)
    {
        try {
            if (empty($professor->getNomeProfessor())) {
                throw new \Exception("O Nome informado é inválido.");
            } else if (strlen($professor->getNomeProfessor()) > 255) {
                throw new \Exception("O Nome excede o limite de caracteres.");
            }else{
                return $this->professorDAO->alterar($professor);
            }

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function carregar($id)
    {
        try {
            $professor = $this->professorDAO->carregar($id);
            if ($professor != null)
                return $professor;
            else
                throw new \Exception("Professor não encontrado!");
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function excluir($id)
    {
        try {
            if ($this->professorDAO->excluir($id))
                return true;
            else
                throw new \Exception("Não foi possível excluir professor!");
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getProfessores()
    {
        try {
            return $this->professorDAO->getProfessores();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getTopFive()
    {
        try {
            return $this->professorDAO->getTopFive();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getCount(){
        try{
            return $this->professorDAO->getCount();
        }catch(\Exception $ex){
            throw $ex;
        }
    }


}