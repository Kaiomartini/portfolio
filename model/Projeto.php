<?php

namespace model;

class Projeto
{
    private $idProjeto;
    private $nomeProjeto;
    private $imagemProjeto;
    private $idSemestre;
    private $idCategoria;
    private $idMateria;
    private $idProfessor;

    private $categoria;
    private $semestre;
    private $professor;

    public function __construct()
    {

    }

    public function getIdProjeto()
    {
        return $this->idProjeto;
    }

    public function setIdProjeto($idProjeto)
    {
        $this->idProjeto = $idProjeto;
    }

    public function getNomeProjeto()
    {
        return $this->nomeProjeto;
    }

    public function setNomeProjeto($nomeProjeto)
    {
        $this->nomeProjeto = $nomeProjeto;
    }

    public function getImagemProjeto()
    {
        return $this->imagemProjeto;
    }

    public function setImagemProjeto($imagemProjeto)
    {
        $this->imagemProjeto = $imagemProjeto;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function getSemestre()
    {
        return $this->semestre;
    }

    public function setSemestre($semestre)
    {
        $this->semestre = $semestre;
    }

    public function getProfessor()
    {
        return $this->professor;
    }

    public function setProfessor($professor)
    {
        $this->professor = $professor;
    }

    public function getIdSemestre()
    {
        return $this->idSemestre;
    }

    public function setIdSemestre($idSemestre)
    {
        $this->idSemestre = $idSemestre;
    }

    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }

    public function getIdMateria()
    {
        return $this->idMateria;
    }

    public function setIdMateria($idMateria)
    {
        $this->idMateria = $idMateria;
    }

    public function getIdProfessor()
    {
        return $this->idProfessor;
    }

    public function setIdProfessor($idProfessor)
    {
        $this->idProfessor = $idProfessor;
    }


}