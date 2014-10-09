<?php

namespace Core;

class Fixture extends Conexao
{

    private function getTable()
    {
        $sql = "SHOW TABLES;";
        $stmt = $this->getInstance()->prepare($sql);
        $stmt->execute();
        $tables = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $tables;

    }

    public function dropTables()
    {
        $tables = $this->getTable();

        $conn = $this->getInstance();

        foreach ($tables as $keys => $values) {
            foreach ($values as $keys1 => $values1) {
                $stmtDrop = $conn->prepare("DROP TABLE {$values1}");
                $result[$values1] = $stmtDrop->execute();
            }
        }

        $result = (isset($result) ? $result : null);

        return $result;
    }

    public function setTabelas($tabelas)
    {

        $stmt = $this->getInstance()->prepare($tabelas);
        $result = $stmt->execute();

        return $result;
    }

    public function getTabelas()
    {
        $tables = $this->getTable();

        foreach ($tables as $keys => $values) {
            foreach ($values as $keys1 => $values1) {
                $result[] = $values1;
            }
        }

        return $result;
    }

    public function insertRegistros($sql)
    {
        $stmt = $this->getInstance()->prepare($sql);
        $result = $stmt->execute();

        return $result;
    }

}