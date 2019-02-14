<?php

namespace model;

class Semestre
{
    private $idSemestre;
    private $nomeSemestre;

    public function __construct()
    {
    }

    public function getIdSemestre()
    {
        return $this->idSemestre;
    }

    public function setIdSemestre($idSemestre)
    {
        $this->idSemestre = $idSemestre;
    }

    public function getNomeSemestre()
    {
        return $this->nomeSemestre;
    }

    public function setNomeSemestre($nomeSemestre)
    {
        $this->nomeSemestre = $nomeSemestre;
    }

}