<?php
class DatabaseConnection {
    public $DATABASE_HOST = "127.0.0.1";
    public $DATABASE_USER = "root";
    public $DATABASE_PASSWORD = "";
    public $sqlConnection;
    function __construct($DATABASE_NAME)
    {
        $this->sqlConnection = new mysqli($this->DATABASE_HOST, $this->DATABASE_PASSWORD, $this->DATABASE_PASSWORD, $DATABASE_NAME);
        if($this->sqlConnection->error)
        {
            die("Database Connection failed: " . $this->sqlConnection->connect_error);
        }
    }
}
?>