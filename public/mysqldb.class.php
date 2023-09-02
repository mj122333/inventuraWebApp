<?php

class MySQLDB
{

    var $host = DB_SERVERNAME;
    var $username = DB_USERNAME;
    var $password = DB_PASSWORD;
    var $database = DB_NAME;

    protected $db;

    function __construct()
    {
        $this->connect();
    }

    function get_db()
    {
        if (!isset($this->db)) {
            $this->connect();
        }
        return $this->db;
    }

    function connect()
    {

        try {
            $conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            $this->db = $conn;
        } catch (mysqli_sql_exception $e) {
            $this->mysql_error("CONNECT", $e->getMessage()); // TODO cant report error wihtout connection
        }
    }

    function select($query, $params = array())
    {

        $db = $this->get_db();
        try {
            $stmt = $db->prepare($query);

            $stmt->execute($params);
            $result['row_count'] = $stmt->rowCount();
            $i = 0;
            while ($row = $stmt->fetch()) {
                $result['result'][$i] = $row;
                $i++;
            }
        } catch (mysqli_sql_exception $e) {
            $this->mysql_error("SELECT", $e->getMessage());
            echo $e;
        }

        return $result;
    }

    function select_one($query, $params = array())
    {

        $db = $this->get_db();
        try {
            $stmt = $db->prepare($query);
            $stmt->execute($params);

            $result['row_count'] = $stmt->rowCount();
            $result['result'] = $stmt->fetch();
        } catch (mysqli_sql_exception $e) {
            $this->mysql_error("SELECT", $e->getMessage());
            echo $e;
        }

        return $result;
    }

    function delete($query, $params = array())
    {
        $db = $this->get_db();
        try {
            $stmt = $db->prepare($query);
            $stmt->execute($params);
        } catch (mysqli_sql_exception $e) {
            $this->mysql_error("DELETE", $e->getMessage());
        }
    }

    function insert($query, $params = array())
    {
        $db = $this->get_db();
        try {
            $stmt = $db->prepare($query);
            $stmt->execute($params);
        } catch (mysqli_sql_exception $e) {
            $this->mysql_error("INSERT", $e->getMessage());
        }
    }

    function update($query, $params = array())
    {
        $db = $this->get_db();
        try {
            $stmt = $db->prepare($query);
            $stmt->execute($params);
        } catch (mysqli_sql_exception $e) {
            $this->mysql_error("UPDATE", $e->getMessage());
        }
    }

    function mysql_error($query, $msg)
    {
        $db = $this->get_db();
        $stmt = $db->prepare("INSERT INTO mysql_errors (query, msg) VALUES (?, ?)");
        $stmt->execute(array($query, $msg));
    }
}