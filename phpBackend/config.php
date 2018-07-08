<?php
class Config{
	public function getConnection(){
    date_default_timezone_set("America/Los_Angeles");    //Set Timezone of a perticular country

		$username="root";
		$password="";
		$dsn="mysql:host=localhost;dbname=test";
		$conn=new PDO($dsn,$username,$password);
		return $conn;
	}
}
?>