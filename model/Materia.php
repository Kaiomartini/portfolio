<?php

namespace model;


class Materia
{
    private $idMateria;
    private $nomeMateria;

    public function __construct()
    {
    }

    public function getIdMateria()
    {
        return $this->idMateria;
    }

    public function setIdMateria($idMateria)
    {
        $this->idMateria = $idMateria;
    }

    public function getNomeMateria()
    {
        return $this->nomeMateria;
    }

    public function setNomeMateria($nomeMateria)
    {
        $this->nomeMateria = $nomeMateria;
    }

}