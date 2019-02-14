<?php

namespace controller;

use dao\MateriaDAO;
use model\Materia;
use util\ConnectionFactory;

class MateriaController
{
    function __construct()
    {
        $this->materiaDAO = MateriaDAO::getInstance(ConnectionFactory::getInstance());
    }

    public function adicionar(Materia $materia)
    {
        try {
            if (empty($materia->getNomeMateria())) {
                throw new \Exception("O Nome informado é inválido.");
            } else if (strlen($materia->getNomeMateria()) > 255) {
                throw new \Exception("O Nome excede o limite de caracteres.");
            } else {
                return $this->materiaDAO->adicionar($materia);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function alterar(Materia $materia)
    {
        try {
            if (empty($materia->getNomeMateria())) {
                throw new \Exception("O Nome informado é inválido.");
            } else if (strlen($materia->getNomeMateria()) > 255) {
                throw new \Exception("O Nome excede o limite de caracteres.");
            } else {
                return $this->materiaDAO->alterar($materia);
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function carregar($id)
    {
        try {
            $materia = $this->materiaDAO->carregar($id);
            if ($materia != null)
                return $materia;
            else
                throw new \Exception("Materia não encontrado!");
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function excluir($id)
    {
        try {
            if ($this->materiaDAO->excluir($id))
                return true;
            else
                throw new \Exception("Não foi possível excluir materia!");
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getMaterias()
    {
        try {
            return $this->materiaDAO->getMaterias();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getTopFive()
    {
        try {
            return $this->materiaDAO->getTopFive();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getCount()
    {
        try {
            return $this->materiaDAO->getCount();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


}