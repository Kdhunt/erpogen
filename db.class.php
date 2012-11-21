<?php

/**
 * db.class.php
 *
 * @version $Id$
 * @copyright 2011
 */
class DB{

	/**
	 * Constructor
	 */
	private $db_user = "musefis_erpogen";
	private $db_pwd = "XXWK11!";
	private $db_name ="musefis_story";
	private $db_host = "localhost";
	private $connection;
	function __construct(){
		$this->connection = mysql_pconnect($this->db_host, $this->db_user, $this->db_pwd);
		if (!$this->connection) {
			die('Could not connect: ' . mysql_error());
		}
		//	echo 'Connected successfully';
		//	mysql_close($this->connection);
		mysql_select_db($this->db_name);

	}

	public function affected_row_count(){
		return mysql_affected_rows();
	}
	public function fetch_array($sql){
		$return_array = array();
		//	echo $this->connection;exit;
		$result = mysql_query($sql, $this->connection);
		if (!$result) {
			echo "Could not successfully run query ($sql) from DB: " . mysql_error();
			return false;
		}
		$row_count = mysql_num_rows($result);
		if ($row_count == 0) {
			echo "No rows found.";
			return false;
		}elseif($row_count > 1){
			while ($row = mysql_fetch_assoc($result)) {
				$return_array[] = $row;
			}
		}else{
			$return_array =  mysql_fetch_assoc($result);
		}
		mysql_free_result($result);
		return $return_array;
	}

	#use for insert, update, delete
	public function run_query($sql){
		$result = mysql_query($sql);
		$id = mysql_insert_id(); //mysql_result (mysql_query ('SELECT LAST_INSERT_ID()'));
		if (!$result) {
			die('Invalid query: ' . mysql_error());
			return false;
		}else{
			return $id;
		}
	}
	#use for select with single row return
	public function run_select($sql){
		$result = mysql_query($sql);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
			return false;
		}else{
			$row = mysql_fetch_row($result);
			return $row;
		}
	}
	#use for select with single return value
	public function get_value($sql){
		//echo $sql;exit;
		$result = mysql_query($sql);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
			return false;
		}else{
			$row = mysql_fetch_row($result);
			return $row[0];
		}
	}
	public function insert_array($sql, $items_array){
		foreach($items_array as $item){
			$q = sprintf($sql, $item);
			$result = $this->run_query($q);
			if(!$result){
				die('Invalid query: ' . mysql_error());
				return false;
			}else{
				continue;
			}
		}
		return true;
	}
	public function get_id(){
		return mysql_insert_id($this->connection);
	}

}

?>