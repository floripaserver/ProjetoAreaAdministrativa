<?php
/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 18/09/14
 * Time: 19:34
 */

namespace Core;

class Model extends Conexao
{

    private $table;
    private $where;
    private $orderBy;
    private $limit;
    private $offSet;
    private $rowCount;

    protected function read()
    {
        $sql = "SELECT * FROM {$this->table} {$this->where} {$this->orderBy} {$this->limit} {$this->offSet}";

        $stmt = $this->getInstance()->prepare($sql);
        $stmt->execute();
        $this->rowCount = $stmt->rowCount();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function getRowCount()
    {
        return $this->rowCount;
    }

    protected function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    protected function setWhere($where)
    {
        $this->where = $where = ($where != null ? "WHERE {$where}" : "");
        return $this;
    }

    protected function setOrder($orderBy)
    {
        $this->orderBy = $order = ($orderBy != null ? "ORDER BY {$orderBy}" : "");
        return $this;
    }

    protected function setLimit($limit)
    {
        $this->limit = $limit = ($limit != null ? "LIMIT {$limit}" : "");
        return $this;
    }

    protected function setOffSet($offSet)
    {
        $this->offSet = $offset = ($offSet != null ? "OFFSET {$offSet}" : "");
        return $this;
    }

    protected function insert($array)
    {
        try {
            if (is_null($array)) {
                throw new \PDOException("Array nao pode ser vazio!");
            }

            if (!is_array($array)) {
                throw new \PDOException("Array invalido");
            }

            $conn = $this->getInstance();

            $conn->beginTransaction();

            $sql = "INSERT INTO {$this->table} (";
            foreach ($array['values'] as $key => $val) {
                $sql .= ", {$key}";
            }
            $sql = preg_replace('/, /', '', $sql, 1);
            $sql .= ") VALUES (";
            foreach ($array['values'] as $key => $val) {
                $sql .= ", ?";
            }
            $sql .= ")";
            $sql = preg_replace('/\(, /', '(', $sql, 1);

            $pre = $conn->prepare($sql);
            $k = 1;
            foreach ($array['values'] as $key => $val) {
                $pre->bindValue($k++, $val);
            }

            $pre->execute();

            $result = $pre->rowCount();

            $conn->commit();

            return $result;

        } catch (\PDOException $e) {
            echo "Codigo do erro: " . $e->getCode() . ", Erro: " . $e->getMessage();
        }
    }

    protected function update($array)
    {
        try {
            if (is_null($array)) {
                throw new \PDOException("Array nao pode ser vazio!");
            }
            if (!is_array($array)) {
                throw new \PDOException("Array invalido");
            }

            $conn = $this->getInstance();

            $conn->beginTransaction();

            $sql = "UPDATE {$this->table} SET ";

            foreach ($array['values'] as $key => $val) {
                $sql .= ", {$key}=?";
            }

            $sql = preg_replace('/, /', '', $sql, 1);

            $sql .= " WHERE ";

            foreach ($array['where'] as $key => $val) {
                $sql .= " AND {$key}=?";
            }

            $sql = preg_replace('/ AND /', '', $sql, 1);

            $pre = $conn->prepare($sql);

            $k = 1;
            foreach ($array['values'] as $key => $val) {
                $pre->bindValue($k++, $val);
            }

            $j = $k;
            foreach ($array['where'] as $key => $val) {
                $pre->bindValue($j++, $val);
            }

            $pre->execute();

            $result = $pre->rowCount();

            $conn->commit();

            return $result;
        } catch (\PDOException $e) {
            echo "Codigo do erro: " . $e->getCode() . ", Erro: " . $e->getMessage();
        }
    }

    protected function delete($array)
    {
        try {
            if (is_null($array)) {
                throw new \PDOException("Array nao pode ser vazio!");
            }
            if (!is_array($array)) {
                throw new \PDOException("Array invalido");
            }

            $conn = $this->getInstance();

            $conn->beginTransaction();

            $sql = "DELETE FROM {$this->table} WHERE ";
            foreach ($array['where'] as $key => $val) {
                $sql .= " AND {$key}=?";
            }

            $sql = preg_replace('/ AND /', '', $sql, 1);

            $pre = $conn->prepare($sql);

            $k = 1;
            foreach ($array['where'] as $key => $val) {
                $pre->bindValue($k++, $val);
            }

            $pre->execute();

            $result = $pre->rowCount();

            $conn->commit();

            return $result;

        } catch (\PDOException $e) {
            echo "Codigo do erro: " . $e->getCode() . ", Erro: " . $e->getMessage();
        }
    }

} 