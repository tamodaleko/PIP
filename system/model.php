<?php

class Model {

	private $connection;

	public function __construct()
	{
		global $config;
		
		try {

            $this->connection = new PDO('mysql:host='.$config["db_host"].';dbname='.$config["db_name"].'', $config['db_username'], $config['db_password']);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        }
        catch (PDOException $connectionError) {

            echo 'ERROR: ' . $connectionError->getMessage();
        }
	}

	public function closeConnection() 
	{
        $this->connection = null;
    }

	public function escapeString($string)
	{
		return $this->connection->quote($string);
	}
	
	public function to_bool($val)
	{
	    return !!$val;
	}
	
	public function to_date($val)
	{
	    return date('Y-m-d', $val);
	}
	
	public function to_time($val)
	{
	    return date('H:i:s', $val);
	}
	
	public function to_datetime($val)
	{
	    return date('Y-m-d H:i:s', $val);
	}
	
	public function query($qry)
	{
		$result = $this->connection->query($qry);
		$resultObjects = array();

		while($row = $result->fetchObject()) $resultObjects[] = $row;

		return $resultObjects;
	}

	public function execute($qry)
	{
		$exec = $this->connection->query($qry);
		return $exec;
	}
    
}
?>
