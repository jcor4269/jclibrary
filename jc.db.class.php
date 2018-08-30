<?php

class JCDB{

	var $db = null;
	var $query = "";

	function __construct(){
	
		// Create PostgresSQL connection
		$host = DB_HOST; 
		$user = DB_USERNAME; 
		$pass = DB_PASSWORD; 
		$db_name = DB_NAME; 

		$con = @mysqli_connect($host, $user, $pass, $db_name) or JCLog::log( "Failed to connect to MySQL: " . mysqli_connect_error());
		
		if(!$con)
			JCLog::exitWithMsg("Cannot connect to Database","Error");
		
		$this->db = $con;
    }
    
    function query($query){

        $result = mysqli_query($this->db, $query);
		
		if($result === false){
			return false;
        }
        return $result;
    }

    function select($query, $type = 'objectlist'){

		//var_dump($query);
        $result = mysqli_query($this->db, $query);
		
		if(!$result){
			return false;
		}
		
		switch($type){

			case 'objectlist':
				$rows = array();
				for($i = 0; $i < mysqli_num_rows($result); $i++){
					$rows[] = mysqli_fetch_object($result); 
				}
				// output data of row
				return $rows;
			
			case 'object':
				return mysqli_fetch_object($result); 
			case 'result':
				$array = mysqli_fetch_array($result);
				//var_dump($array);
				return $array[0];

		}
        
	}
	
	function insertIntoTable($table_name, $params){

		$fields = array_keys($params);
		$values = array_values($params);
		$sql = "INSERT INTO $table_name (".implode(',',$fields).") VALUES('".implode("','",$values)."')";
		if($this->query($sql))
			return mysqli_insert_id($this->db);
		return false;
	}

	function selectTable($table_name){

		$this->query = "SELECT * FROM $table_name";
		return $this;
	}

	function where($field, $operator, $value){

		$this->query .= " WHERE $field $operator $value";
		return $this;
	}

	function get($type = 'objectlist'){

		//var_dump($this->query);
		return $this->select($this->query, $type);
	}

	function update($table_name, $params, $id, $id_fieldname = 'id'){

		$fields = array_keys($params);
		$values = array_values($params);
		$sql = "UPDATE $table_name SET ";
		$first = true;
		foreach($params as $field => $value){

			if($first)
				$first = false;
			else
				$sql .= ", ";

			$sql .= "$field = '$value' ";
		}
		$sql .= " WHERE $id_fieldname = '$id' ";
		if($this->query($sql))
			return mysqli_insert_id($this->db);
		return false;
	}
}
?>