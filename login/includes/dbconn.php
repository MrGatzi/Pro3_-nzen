<?php
// Database connection
class DbConn
{
    public $conn;
    public function __construct()
    {
        require 'dbconf.php';
        $this->host = $host; // Host name
        $this->email = $email; // Mysql username
        $this->password = $password; // Mysql password
        $this->db_name = $db_name; // Database name
        $this->tbl_prefix = $tbl_prefix; // Prefix for all database tables
        $this->tbl_members = $tbl_members;

        try {
			// Connect to server and select database.
			$this->conn = new PDO('mysql:host=' . $host . ';dbname=' . $db_name . ';charset=utf8', $email, $password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (\Exception $e) {
			die('Database connection error');
		}
    }
}
