<?php
class connect 
{ 
    private $host = "localhost";
    private $db_name = "pounds";
    private $username = "roott";
    private $password = "stardawn3000!";

    public $conn;
    
    public function connect()
    {
       
       $this->conn = null;    
       try
       {
        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
    }
    catch(PDOException $exception)
    {
        echo "Connection error: " . $exception->getMessage();
    }
    
    return $this->conn;
}
public function setdata($sql)
{
  mysql_query($sql);
}
public function getdata($sql)
{
  return mysql_query($sql);
}
public function delete($sql)
{
  mysql_query($sql);
}
}
?>