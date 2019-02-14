<?php

namespace model;

class Professor
{
    private $idProfessor;
    private $nomeProfessor;

    public function __construct()
    {
    }

    public function getIdProfessor()
    {
        return $this->idProfessor;
    }

    public function setIdProfessor($idProfessor)
    {
        $this->idProfessor = $idProfessor;
    }

    public function getNomeProfessor()
    {
        return $this->nomeProfessor;
    }

    public function setNomeProfessor($nomeProfessor)
    {
        $this->nomeProfessor = $nomeProfessor;
    }

}