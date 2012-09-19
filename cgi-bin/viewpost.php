<?php

require("info.php");

class viewShow {
	public $mysql;
	public $db;
	public $query;
	public $result;
	public $numrows;
	public $row;

	public function postShow() {
		$this->openDB();
		$this->selectDB();
		$this->queryDB();
		$this->printPost();
		$this->closeDB();
	}

		public function openDB() {
			@$this->mysql= mysqli_connect($dbhost,$dbuser,$dbpassword);
			if (!$this->mysql) {
				echo "Cannot connect!";
				exit;
			}
		}

		public function selectDB() {
			@$this->db = mysqli_select_db($this->mysql,$dbname);
			if (!$this->db){
				echo "Cannot find database!";
				exit;
			}
		}
		
		public function queryDB() {
			$this->query = "select * from shows";
			@$this->result = mysqli_query($this->mysql, $this->query);
			if (!$this->result){
				echo "Cannot show result!";
				exit;
			}
		}
		
		public function printPost() {
			session_start();
			$this->numrows = mysqli_num_rows($this->result);
			for ($i=0; $i < $this->numrows; $i++) {
				$this->row = mysqli_fetch_assoc($this->result);
			echo "<div class=\"date\">".$this->row['date'];
			echo "<span class=\"venue\">".$this->row['venue']."</span><br />";
			echo "<p class=\"info\">".nl2br($this->row['info'])."<br /></p>";
			echo "<div class=\"link\"><a href=\"\">Link</a></div></div><hr />";
			}
			mysqli_free_result($this->result);
		}
		
		public function closeDB() {
			mysqli_close($this->mysql);
		}

	}
?>
