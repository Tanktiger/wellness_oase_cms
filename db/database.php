<?php
class Database {
    private $db;
    private $host = '';
    private $user = '';
    private $password = '';
    private $database = '';

    function __construct($host = 'localhost', $user = 'root', $pw = '', $dbname = 'test') {
        $this->host = $host;
        $this->user = $user;
        $this->password = $pw;
        $this->database = $dbname;
        $this->connect();
    }
    function connect() {
        $this->db = new mysqli($this->host, $this->user, $this->password, $this->database);
        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
        mysqli_set_charset($this->db,"utf8");
    }
    function close() {
        $this->db->close();
    }
    function query($query) {
        return $this->db->query($query);
    }
    function getDB() {
        return $this->db;
    }
}