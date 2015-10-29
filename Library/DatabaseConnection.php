<?php
namespace Library;

class DatabaseConnection {

    private static $_instance;

    /**
     * @return DatabaseConnection
     */
    public static function getInstance() {
        if (!static::$_instance) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    private $_pdo;

    private function __construct()  {
        $engine     = Configuration::get('db.engine');
        $host       = Configuration::get('db.host');
        $user       = Configuration::get('db.user');
        $password   = Configuration::get('db.password');
        $database   = Configuration::get('db.name');
        $connectionString = "$engine:host=$host;dbname=$database";
        $this->_pdo = new \PDO($connectionString, $user, $password);
    }

    /**
     * @param $sql
     * @return \PDOStatement
     */
    public function query($sql) {
        /**
         * @var \PDOStatement $result
         */
        $result = $this->_pdo->query($sql);
        if ($result === false) {
            var_dump($this->_pdo->errorInfo());
            die;
        }
        return $result;
    }

    public function fetchAll($sql) {
        $statement = $this->query($sql);
        return array_map(function($array) {
            return (object)$array;
        }, $statement->fetchAll(\PDO::FETCH_ASSOC));
//        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchOne($sql) {
        $statement = $this->query($sql);
        return $statement->fetchObject();
    }

    public function execute($sql) {
        return $this->query($sql)->execute();
    }
}