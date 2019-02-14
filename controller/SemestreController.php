<?php

namespace controller;

use dao\SemestreDAO;
use model\Semestre;
use util\ConnectionFactory;

class SemestreController
{
    function __construct()
    {
        $this->semestreDAO = SemestreDAO::getInstance(ConnectionFactory::getInstance());
    }

    public function adicionar(Semestre $semestre)
    {
        try {
            if (empty($semestre->getNomeSemestre())) {
                throw new \Exception("O Nome informado é inválido.");
            } else if (strlen($semestre->getNomeSemestre()) > 255) {
                throw new \Exception("O Nome excede o limite de caracteres.");
            }else{
                return $this->semestreDAO->adicionar($semestre);
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function alterar(Semestre $semestre)
    {
        try {
            if (empty($semestre->getNomeSemestre())) {
                throw new \Exception("O Nome informado é inválido.");
            } else if (strlen($semestre->getNomeSemestre()) > 255) {
                throw new \Exception("O Nome excede o limite de caracteres.");
            }else{
                return $this->semestreDAO->alterar($semestre);
            }

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function carregar($id)
    {
        try {
            $semestre = $this->semestreDAO->carregar($id);
            if ($semestre != null)
                return $semestre;
            else
                throw new \Exception("Semestre não encontrado!");
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function excluir($id)
    {
        try {
            if ($this->semestreDAO->excluir($id))
                return true;
            else
                throw new \Exception("Não foi possível excluir semestre!");
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getSemestres()
    {
        try {
            return $this->semestreDAO->getSemestres();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getTopFive()
    {
        try {
            return $this->semestreDAO->getTopFive();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getCount()
    {
        try {
            return $this->semestreDAO->getCount();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


}