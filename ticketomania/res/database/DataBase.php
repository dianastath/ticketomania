<?php 

class Database {
    //private $host =     'localhost';
    //private $username = 'marianna';
    //private $password = 'Paros!1999';
    //private $db_name =  'ticketomania';
    
    private $host =     'localhost';
    private $username = 'lmac4ana';
    private $password = 'aua!15ate';
    private $db_name =  'ticketomania';
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function close() {
        $this->conn->close();
    }
	
	public function GetLastInsertedID() {
		return mysqli_insert_id($this->conn); 
	}
	
}

?>