<?php
/**
 * Created by PhpStorm.
 * User: AtmosphereMao
 * Date: 2020/6/19
 * Time: 21:16
 */

namespace core;

class DB
{
    private function __construct()
    {
    }

    private static $DB;

    public static function getInstance()
    {
        if (self::$DB == NULL) {
            $config = Config::getList();
            $db = new \mysqli(
                $config["DB_HOST"],
                $config["DB_USERNAME"],
                $config["DB_PASSWORD"],
                $config["DB_DATABASE"],
                (int)$config["DB_PORT"]
            );
            self::$DB = $db;
        }
        return self::$DB;
    }
}
class Database
{
    private $queryString;    // SQL query string
    private $queryData = array();      // SQL bind data
    private $mode = '';


    public function select($tableName)
    {
        $this->mode = 's';
        $this->queryString = "SELECT * FROM `$tableName` ";
        return $this;
    }

    public function insert($tableName, $data)
    {
        $this->mode = 'i';
        $keyString = implode(',', array_keys($data));

        $valueMask = '';

        for ($i = 0; $i < count(array_values($data)); $i++) {
            $valueMask .= '?';
            if ($i !== count(array_values($data)) - 1) {
                $valueMask .= ',';
            }
        }

        $this->queryString = "INSERT INTO `$tableName` ($keyString) VALUES ($valueMask)";
        if (!is_array($data)) {
            $this->queryData = array_merge($this->queryData, array($data));
        } else {
            $this->queryData = array_merge($this->queryData, $data);
        }
        return $this->end();
    }

    public function update($tableName, $data)
    {
        $this->mode = 'u';
        $this->queryString = "UPDATE `$tableName` SET ";

        $dataKey = array_keys($data);
        $keyString = '';
        foreach ($dataKey as $k => $item) {
            $keyString .= '`' . $item . '` = ?';
            if ($k !== count($dataKey) - 1) {
                $keyString .= ', ';
            }
        }
        $this->queryString .= $keyString;
        $this->queryData = array_merge($this->queryData, $data);

        return $this;
    }

    public function delete($tableName)
    {
        $this->mode = 'd';
        $this->queryString = "DELETE FROM `$tableName` ";
        return $this;
    }

    public function end()
    {
        $db = DB::getInstance();
        $stmt = $db->prepare($this->queryString);
        $stmtType = '';
        foreach ($this->queryData as $value) {
            if (is_integer($value)) {
                $stmtType .= 'i';
            } else if (is_double($value)) {
                $stmtType .= 'd';
            } else {
                $stmtType .= 's';
            }
        }

        if ($stmt !== false) {
            if ($stmtType !== '') {
                $stmt->bind_param($stmtType, ...array_values($this->queryData));
            }
            $stmt->execute();
            $result = $stmt->get_warnings();
            return $result;
        }
        return false;
    }

    public function where($query, $data = array())
    {
        $this->queryString .= " WHERE ($query)";

        // single param
        if (!is_array($data)) {
            $this->queryData = array_merge($this->queryData, array($data));
        } else {
            $this->queryData = array_merge($this->queryData, $data);
        }
        return $this;
    }

    public function fetch()
    {
        $this->queryString .= ';';
        $db = DB::getInstance();
        $stmt = $db->prepare($this->queryString);

        $stmtType = '';
        foreach ($this->queryData as $value) {
            if (is_integer($value)) {
                $stmtType .= 'i';
            } else if (is_double($value)) {
                $stmtType .= 'd';
            } else {
                $stmtType .= 's';
            }
        }
        $data = [];
        if ($stmt !== false) {
            if ($stmtType !== '') {
                $stmt->bind_param($stmtType, ...$this->queryData);
            }
            $stmt->execute();
            $result = $stmt->get_result();

            while ($r = $result->fetch_array(MYSQLI_ASSOC)) {
                array_push($data, $r);
            }
        }
        return $data;
    }
}