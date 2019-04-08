<?php
class Mysqli {
	var $db_connect_id;
	var $query_result;
	var $row = array ();
	var $rowset = array ();
	var $num_queries = 0;
	function __construct($sqlserver, $sqluser, $sqlpassword, $database, $puerto) {
		$this->puerto   = $puerto;
		$this->user     = $sqluser;
		$this->password = $sqlpassword;
		$this->server   = $sqlserver;
		$this->dbname   = $database;
		die("aaa    ".$this->server."   ****  ".$this->user."   ****  ".$this->password."   ****  ".$this->dbname."   ****  ".$this->puerto );
		
		$this->db_connect_id = @mysqli_connect ( $this->server, $this->user, $this->password, $this->dbname, $this->puerto);
		if ($this->db_connect_id) {
			return $this->db_connect_id;
		} else {
			return false;
		}
	}
	function sql_close() {
		if ($this->db_connect_id) {
			if ($this->query_result) {
				@mysqli_free_result ( $this->query_result );
			}
			$result = @mysqli_close ( $this->db_connect_id );
			return $result;
		} else {
			return false;
		}
	}
	function sql_query($query = "", $transaction = false) {
		// Remove any pre-existing queries
		unset ( $this->query_result );
		if ($query != "") {
			$this->query_result = @mysqli_query ( $this->db_connect_id, $query );
		}
		if ($this->query_result) {
			unset ( $this->row [$this->query_result] );
			unset ( $this->rowset [$this->query_result] );
			return $this->query_result;
		} else {
			return false;
		}
	}
	
	//
	// Other query methods
	//
	function sql_numrows($query_id = 0) {
		if (! $query_id) {
			$query_id = $this->query_result;
		}
		if ($query_id) {
			$result = @mysqli_num_rows ( $query_id );
			return $result;
		} else {
			return false;
		}
	}
	function sql_affectedrows() {
		if ($this->db_connect_id) {
			$result = @mysqli_affected_rows ( $this->db_connect_id );
			return $result;
		} else {
			return false;
		}
	}
	function sql_numfields($query_id = 0) {
		if (! $query_id) {
			$query_id = $this->query_result;
		}
		if ($query_id) {
			$result = @mysqli_num_fields ( $query_id );
			return $result;
		} else {
			return false;
		}
	}
	function sql_fetchass($query_id = 0) {
		if (! $query_id) {
			$query_id = $this->query_result;
		}
		if ($query_id) {
			$this->row [$query_id] = @mysqli_fetch_assoc ( $query_id );
			return $this->row [$query_id];
		} else {
			return false;
		}
	}
	function sql_fetchrow($query_id = 0) {
		if (! $query_id) {
			$query_id = $this->query_result;
		}
		if ($query_id) {
			$this->row [$query_id] = @mysqli_fetch_array ( $query_id );
			return $this->row [$query_id];
		} else {
			return false;
		}
	}
	function sql_fetchrowset($query_id = 0) {
		if (! $query_id) {
			$query_id = $this->query_result;
		}
		if ($query_id) {
			unset ( $this->rowset [$query_id] );
			unset ( $this->row [$query_id] );
			while ( $this->rowset [$query_id] = @mysql_fetch_array ( $query_id ) ) {
				$result [] = $this->rowset [$query_id];
			}
			return $result;
		} else {
			return false;
		}
	}
	function sql_fetchfield($field, $rownum = -1, $query_id = 0) {
		if (! $query_id) {
			$query_id = $this->query_result;
		}
		if ($query_id) {
			if ($rownum > - 1) {
				$result = @mysqli_result ( $query_id, $rownum, $field );
			} else {
				if (empty ( $this->row [$query_id] ) && empty ( $this->rowset [$query_id] )) {
					if ($this->sql_fetchrow ()) {
						$result = $this->row [$query_id] [$field];
					}
				} else {
					if ($this->rowset [$query_id]) {
						$result = $this->rowset [$query_id] [$field];
					} else if ($this->row [$query_id]) {
						$result = $this->row [$query_id] [$field];
					}
				}
			}
			return $result;
		} else {
			return false;
		}
	}
	function sql_rowseek($rownum, $query_id = 0) {
		if (! $query_id) {
			$query_id = $this->query_result;
		}
		if ($query_id) {
			$result = @mysqli_data_seek ( $query_id, $rownum );
			return $result;
		} else {
			return false;
		}
	}
	function sql_nextid() {
		if ($this->db_connect_id) {
			$result = @mysqli_insert_id ( $this->db_connect_id );
			return $result;
		} else {
			return false;
		}
	}
	function sql_freeresult($query_id = 0) {
		if (! $query_id) {
			$query_id = $this->query_result;
		}
		
		if ($query_id) {
			unset ( $this->row [$query_id] );
			unset ( $this->rowset [$query_id] );
			@mysql_free_result ( $query_id );
			return true;
		} else {
			return false;
		}
	}
	function sql_error($query_id = 0) {
		$result ["message"] = @mysqli_error ( $this->db_connect_id );
		$result ["code"] = @mysqli_errno ( $this->db_connect_id );
		return $result;
	}
}
?>