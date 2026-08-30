<?php

namespace OffTheGridCG;

use PDOException;

class DB{
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $this->connect();
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function connect() {
        $config = CONFIG::getInstance();
        $host = $config->get('MYSQL_HOST');
        $port = $config->get('MYSQL_PORT');
        $dbname = $config->get('MYSQL_DATABASE');
        $user = $config->get('MYSQL_USER');
        $password = $config->get('MYSQL_PASSWORD');

        try {
            $this->pdo = new \PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function close() {
        $this->pdo = null;
        self::$instance = null;
    }

    public function queryExec($query, $parameters = []) {
        try {
            $sth = $this->pdo->prepare($query);
            $sth->execute($parameters);
            return $sth->rowCount();
        } catch (PDOException $e) {
            error_log("PDO_DB_EXEC_ERR: ".$e->getMessage());
            return null;
        }
    }

    public function query($query, $parameters = [], $limit = null, $offset = null) {
        try {
            $appendix = "";
            if ($limit !== null) $appendix .= " LIMIT ".(int)$limit;
            if ($offset !== null) $appendix .= " OFFSET ".(int)$offset;
            $sth = $this->pdo->prepare($query.$appendix);
            $sth->execute($parameters);
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("PDO_DB_QUERY_ERR: ".$e->getMessage());
            return null;
        }
    }

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }
}