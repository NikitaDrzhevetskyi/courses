<?php

namespace core;

use PDOException;

class DB
{
    protected $pdo;
    public function __construct($host, $dbname, $user, $password)
    {
        $this->pdo = new \PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$user ,$password);
    }

    /**
     * Проверяем параметры
     */
    protected function checkFieldsAndWhere($where, $fields=null)
    {
        if(is_array($fields)){
            $resultStr['fields'] = implode(', ', $fields);
        }else {
            $resultStr['fields'] = $fields;
        }

        if (is_array($where) and !empty($where)) {
            $whereParts = [];
            foreach ($where as $key => $value) {
                $whereParts[] = "{$key} = ? ";
            }
            $resultStr['where'] = "WHERE " . implode(' AND ', $whereParts);
            $resultStr['values'] = array_values($where);
        } else
            if (is_string($where) and strlen($where) > 0) {
                $resultStr['where'] = "WHERE " . $where;
            }
        return $resultStr;
    }

    /**
     * CRUD (Read)
     */
    public function Select($table, $fields = '*', $join = null, $where = null, $orderBy = null, $offset = null, $limit = null, $having = null, $group=null)
    {
        $selectStr = self::checkFieldsAndWhere($where, $fields);

        $sql = "SELECT {$selectStr['fields']} FROM {$table} {$join} {$selectStr['where']}";

        //ORDER
        if (is_array($orderBy)) {
            $orderByParts = [];
            foreach ($orderBy as $key => $value) {
                $orderByParts[] = "{$key} {$value}";
            }
            $sql .= ' ORDER BY ' . implode(', ', $orderByParts);
        } else if (is_string($orderBy)) {
            $sql .= ' ORDER BY ' . $orderBy;
        }

        //LIMIT
        if (!empty($limit)) {
            if (!empty($offset)) {
                $sql .= " LIMIT {$offset}, {$limit} ";
            } else {
                $sql .= " LIMIT {$limit} ";
            }
        }

        if (!empty($having)) {
            $sql .= " HAVING {$having} ";
        }
        if (!empty($group)) {
            $sql .= " GROUP BY {$group} ";
        }

        $sth = $this->pdo->prepare($sql);
        $sth->execute($selectStr['values']);
        return $sth->fetchAll();
    }



     /**
      * CRUD (Create)
      */
    public function Insert($table, $fields = null)
    {
        if(is_array($fields)){
            $resultStr['fields'] = implode(', ', array_keys($fields));
            $values = [];
            foreach ($fields as $key => $value) {
                $values[] = "?";
            }
            $resultStr['values'] = implode(', ', array_values($values));
        }else {
            $resultStr['fields'] = $fields;
        }
        $sql = "INSERT INTO {$table} ({$resultStr['fields']}) VALUES ({$resultStr['values']})";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array_values($fields));
            return $this->pdo->lastInsertId();
    }


    /**
     * CRUD (Update)
     */
    public function Update($table, $fields, $where = null)
    {
        $resultArr = [];
        if (is_array($fields) and !empty($fields)) {
            $fieldsParts = [];
            foreach ($fields as $key => $value) {
                $fieldsParts[] = "{$key} = ?";
                $resultArr[] = $value;
            }
            $resultStr['fields'] = "SET " . implode(', ', $fieldsParts);
        } else if (is_string($fields) and strlen($fields) > 0) {
            $resultStr['fields'] = $fields;
        }
        //$where
        if (is_array($where) and !empty($where)) {
            $whereParts = [];
            foreach ($where as $key => $value) {
                $whereParts[] = "{$key} = ? ";
                $resultArr[] = $value;
            }
            $resultStr['where'] = "WHERE " . implode(' AND ', $whereParts);
            $resultStr['wherevalues'] = array_values($where);
        } else
            if (is_string($where) and strlen($where) > 0) {
                $resultStr['where'] = "WHERE " . $where;
            }

        try {
            $sql = "UPDATE {$table} {$resultStr['fields']}  {$resultStr['where']}";
            $sth = $this->pdo->prepare($sql);
            $sth->execute($resultArr);

            return true;
            }catch (PDOException $e) {
                return false;
            }
    }

    /**
     * CRUD (Delete)
    */
    public function Delete($table, $where = null)
    {
        $selectStr = self::checkFieldsAndWhere($where);

        $sql = "DELETE FROM {$table} {$selectStr['where']}";

        $sth = $this->pdo->prepare($sql);
        if($where === null)
            $sth->execute();
        else
            $sth->execute($selectStr['values']);

    }


    public function backup(string $host, string $databaseName, string $user, string $password)
    {
        if (!file_exists($_SERVER["DOCUMENT_ROOT"] . "/backup")) {
            mkdir($_SERVER["DOCUMENT_ROOT"] . "/backup");
        }

        $filename = $databaseName . "_" . date("Y-m-d");
        $folder = $_SERVER["DOCUMENT_ROOT"] . "/backup/" . $filename . ".sql";
        var_dump($filename);
        var_dump($folder);
        exec("mysqldump --user={$user} --password={$password} --host={$host} {$databaseName} --result-file={$folder} 2>&1", $output);
        var_dump($output);
    }


}