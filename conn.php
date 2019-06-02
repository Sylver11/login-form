<?php
// require_once 'user.php';
// $conn = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
// if($conn->connect_error){
//     die("connection failed: " . $conn->connect_error);
// }


Class Connection{
 
	private $server = "mysql:host=localhost;dbname=todo";
	private $username = "root";
	private $password = "";
	private $options  = array(PDO::MYSQL_ATTR_FOUND_ROWS   => TRUE, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	protected $conn;
 	
	public function open(){
 		try{
 			$this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
             return $this->conn;
            //  alter("this runs");
 		}
 		catch (PDOException $e){
             echo "There is some problem in connection: " . $e->getMessage();
            //  alert("this does not work");
 		}
 
    }
 
	public function close(){
   		$this->conn = null;
 	}
 
}



?>