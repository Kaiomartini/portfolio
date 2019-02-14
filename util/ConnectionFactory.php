<?php
namespace util;

/*
*     __           ____
*     |  | __  ____/_   |
*     |  |/ / / ___\|   |
*     |    < / /_/  >   |
*     |__|_ \\___  /|___|
*         \/_____/
 * Copyright © kaique.tech 1998-2018. Todos os Direitos Reservados.
 * Desenvolvido por: Kaique Gazola (kaique.gazola@fatec.sp.gov.br).
 */

/*
 * Constantes de parâmetros para configuração da conexão   
 */
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

define('HOST', 'localhost');
define('DBNAME', 'portifolio');
define('USER', 'root');
define('PASSWORD', '');

define('CHARSET', 'utf8mb4');

class ConnectionFactory
{
    /*
     * Atributo estático para instância do PDO   
     */

    private static $pdo;

    /*
     * Escondendo o construtor da classe   
     */

    private function __construct()
    {
        //
    }

    /*
     * Método estático para retornar uma conexão válida   
     * Verifica se já existe uma instância da conexão, caso não, configura uma nova conexão   
     */

    public static function getInstance()
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new \PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=" . CHARSET . ";", USER, PASSWORD);
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::checkTables();
            } catch (\PDOException $e) {
                if ($e->getCode() === 1049) {
                    self::createDB();
                }
            }
        }
        return self::$pdo;
    }

    public static function createDB()
    {
        try {
            self::$pdo = new \PDO("mysql:host=" . HOST . "; charset=" . CHARSET . ";", USER, PASSWORD);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE IF NOT EXISTS " . DBNAME;
            self::$pdo->exec($sql);
            self::$pdo = null;
            self::getInstance();
            self::createTables();
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public static function createTables()
    {
        try {
            $sql = "CREATE TABLE IF NOT EXISTS Semestre (idSemestre integer not null primary key auto_increment, nomeSemestre varchar(255));";
            self::$pdo->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS Categoria (idCategoria integer not null primary key auto_increment, nomeCategoria varchar(255));";
            self::$pdo->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS Professor (idProfessor integer not null primary key auto_increment, nomeProfessor varchar(255));";
            self::$pdo->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS Materia (idMateria integer not null primary key auto_increment, nomeMateria varchar(255));";
            self::$pdo->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS Projeto (idProjeto integer not null primary key auto_increment, nomeProjeto varchar(255), imagemProjeto varchar(1000), idProfessor integer references Professor(idProfessor), idCategoria integer references Categoria(idCategoria), idSemestre integer references Semestre(idSemestre), idMateria integer references Materia(idMateria));";
            self::$pdo->exec($sql);
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public static function checkTables()
    {
        try {
            self::$pdo->query("SELECT 1 FROM Categoria limit 1");
        } catch (\PDOException $ex) {
            if ($ex->getCode() == "42S02") {
                self::createTables();
            }
        }
    }

}
