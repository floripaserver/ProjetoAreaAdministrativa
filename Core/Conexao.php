<?php

namespace Core;

class Conexao
{
    private $dbHost;
    private $db;
    private $dbName;
    private $dbUser;
    private $dbPass;
    private $instancia = null;

    private function setConfigDB()
    {
        $config = include 'Config/Config.php';

        try {

            if (!isset($config['db'])) {
                throw new \InvalidArgumentException('Configuração do banco de dados inválido');
            }

            $this->dbHost = $config['db']['host'];
            $this->db = $config['db']['banco'];
            $this->dbName = $config['db']['dbname'];
            $this->dbUser = $config['db']['user'];
            $this->dbPass = $config['db']['pass'];

        } catch (\Exception $e) {
            echo $e->getMessage() . '<br>';
            echo $e->getTraceAsString();
        }
    }

    protected function getInstance()
    {
        if (!isset($this->instancia)) {

            $this->setConfigDB();

            try {
                $this->instancia = new \PDO($this->db . ':host=' . $this->dbHost . ';dbname=' . $this->dbName
                    , $this->dbUser
                    , $this->dbPass);

            } catch (\PDOException $e) {
                echo 'Erro: ' . $e->getCode() . ' - ' . $e->getMessage();
            }
        }
        return $this->instancia;
    }

}