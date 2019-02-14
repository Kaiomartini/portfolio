<?php

namespace controller;

use dao\CategoriaDAO;
use model\Categoria;
use util\ConnectionFactory;

class CategoriaController
{
    function __construct()
    {
        $this->categoriaDAO = CategoriaDAO::getInstance(ConnectionFactory::getInstance());
    }

    public function adicionar(Categoria $categoria)
    {
        try {
            if (empty($categoria->getNomeCategoria())) {
                throw new \Exception("O Nome informado é inválido.");
            } else if (strlen($categoria->getNomeCategoria()) > 255) {
                throw new \Exception("O Nome excede o limite de caracteres.");
            }else {
                return $this->categoriaDAO->adicionar($categoria);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function alterar(Categoria $categoria)
    {
        try {
            if (empty($categoria->getNomeCategoria())) {
                throw new \Exception("O Nome informado é inválido.");
            } else if (strlen($categoria->getNomeCategoria()) > 255) {
                throw new \Exception("O Nome excede o limite de caracteres.");
            }else{
                return $this->categoriaDAO->alterar($categoria);
            }

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function carregar($id)
    {
        try {
            $categoria = $this->categoriaDAO->carregar($id);
            if ($categoria != null)
                return $categoria;
            else
                throw new \Exception("Categoria não encontrado!");
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function excluir($id)
    {
        try {
            if ($this->categoriaDAO->excluir($id))
                return true;
            else
                throw new \Exception("Não foi possível excluir categoria!");
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getCategorias()
    {
        try {
            return $this->categoriaDAO->getCategorias();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getTopFive()
    {
        try {
            return $this->categoriaDAO->getTopFive();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getCount(){
        try{
            return $this->categoriaDAO->getCount();
        }catch(\Exception $ex){
            throw $ex;
        }
    }


}