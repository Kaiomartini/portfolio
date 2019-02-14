<?php

namespace controller;

use dao\ProjetoDAO;
use model\Categoria;
use model\Projeto;
use util\ConnectionFactory;

class ProjetoController
{
    function __construct()
    {
        $this->projetoDAO = ProjetoDAO::getInstance(ConnectionFactory::getInstance());
    }

    public function adicionar(Projeto $projeto)
    {
        try {
            if (empty($projeto->getNomeProjeto())) {
                throw new \Exception("O Nome informado é inválido.");
            } else if (strlen($projeto->getNomeProjeto()) > 255) {
                throw new \Exception("O Nome excede o limite de caracteres.");
            } else if (empty($projeto->getIdCategoria())) {
                throw new \Exception("A Categoria informada é inválida.");
            } else if (empty($projeto->getIdMateria())) {
                throw new \Exception("A Materia informada é inválida.");
            } else if (empty($projeto->getIdSemestre())) {
                throw new \Exception("O Semestre informado é inválido.");
            } else if (empty($projeto->getIdProfessor())) {
                throw new \Exception("O Professor informado é inválido.");
            } else {
                return $this->projetoDAO->adicionar($projeto);
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function alterar(Projeto $projeto)
    {
        try {
            if (empty($projeto->getNomeProjeto())) {
                throw new \Exception("O Nome informado é inválido.");
            } else if (strlen($projeto->getNomeProjeto()) > 255) {
                throw new \Exception("O Nome excede o limite de caracteres.");
            } else if (empty($projeto->getIdCategoria())) {
                throw new \Exception("A Categoria informada é inválida.");
            } else if (empty($projeto->getIdMateria())) {
                throw new \Exception("A Materia informada é inválida.");
            } else if (empty($projeto->getIdSemestre())) {
                throw new \Exception("O Semestre informado é inválido.");
            } else if (empty($projeto->getIdProfessor())) {
                throw new \Exception("O Professor informado é inválido.");
            } else {
                return $this->projetoDAO->alterar($projeto);
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function carregar($id)
    {
        try {
            $projeto = $this->projetoDAO->carregar($id);
            if ($projeto != null)
                return $projeto;
            else
                throw new \Exception("Projeto não encontrado!");
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function excluir($id)
    {
        try {
            if ($this->projetoDAO->excluir($id))
                return true;
            else
                throw new \Exception("Não foi possível excluir projeto!");
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getProjetos()
    {
        try {
            return $this->projetoDAO->getProjetos();
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function getTopFiveByCategory(Categoria $categoria)
    {
        try {
            return $this->projetoDAO->getTopFiveByCategory($categoria);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getCount()
    {
        try {
            return $this->projetoDAO->getCount();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


}