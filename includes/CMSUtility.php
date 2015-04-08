<?php
include_once 'config.php';

class Article {

	public $id;
	public $name;
	public $data;

	function __construct($id, $name, $data) 
	{
	   $this->id = $id;
	   $this->name = $name;
	   $this->data = $data;
	}
} 

class CMSUtility {

	private static function init() {
					
	}

	private static function conn() {

		$conn = new mysqli(HOST, USER, PASSWORD, DATABASE);

		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySql: " . mysqli_connect_error();
		}
		
		return $conn;
	}

	private static function GetArticleByName($name) {
		$conn = self::conn();

		if($stmt = $conn->prepare("SELECT Id, Name, Data FROM Content WHERE Name = ?")) {
			
		    $stmt->bind_param("s" ,$name);
	        $stmt->execute();
				$stmt -> bind_result($id, $name, $data);
	      	$stmt -> fetch();
			$stmt->close();
	   	}

	   	$conn->close();
	   	//return $result;
	   	return new Article($id, $name, $data);
	}
	
	public static function GetAllArticles() {
		$conn = self::conn();

		$sqlCommand = "SELECT Id, Name, Data FROM Content";

		$result = $conn->query($sqlCommand);
		$articles = array();

		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		    	array_push($articles, new Article($row["Id"], $row["Name"], $row["Data"]));
		    }
		} else {
		    echo "0 results";
		}

		$conn->close();

		return $articles;
	}

	public static function ContentLiteral($name) {
		self::init();							
		$article = self::GetArticleByName($name);
		echo($article->data);
	}

	public static function UpdateArticleByName($name, $data) {
		$conn = self::conn();
		$article = self::GetArticleByName($name);
		
		if ($article->id == 0) {
			if($stmt = $conn->prepare("INSERT INTO Content (Name, Data) VALUES (?, ?)")) {
				$stmt->bind_param("ss", $name, $data);
		        $stmt->execute();
				$stmt->close();
			}
		}		
		else if($stmt = $conn->prepare("UPDATE Content SET Data = ? WHERE Name = ?")) {
			$stmt->bind_param("ss", $data, $name);
	        $stmt->execute();
			$stmt->close();
		}

		$conn->close();
		return;
	}
}
?>