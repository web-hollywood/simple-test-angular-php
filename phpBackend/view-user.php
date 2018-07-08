<?php
ob_start();
    include('config.php');  //configuration file
    $c=new Config;
    $conn=$c->getConnection();
   
    /*------Check Validation for DeviceID---*/
    if(!isset($_POST['DeviceID']) || empty($_POST['DeviceID'])){ 
		$r["re"]="DeviceID can not be empty."; 
   		$post=array("re"=>$r["re"]);
   		$rdd=$post;
		header("content-type:application/json");
		print_r(json_encode($rdd));
		die();
    }
	
	
	   $DeviceID=$_POST['DeviceID'];   
	   
   
    /*------------------------------------------------------------------------------*/
	$sql="SELECT * FROM `register` WHERE `DeviceID`='$DeviceID'";  //Check for DeviceID existance in database
    $record=$conn->query($sql);
    $rowcount=$record->rowCount();
   
    $post=array();
   
		if($rowcount >= 1){
		$res=array();  
   		foreach($record as $row){
			$rd=$row['id'];
			
			$res[]=array("DeviceID"=> $row['DeviceID'],"DeviceName"=> $row['DeviceName'],"BatteryStatus"=> $row['BatteryStatus'],"Longitude"=> $row['Longitude'],"Latitude"=> $row['Latitude'],"Timestamp"=> $row['Timestamp'],"Status"=> $row['Status']);
			
		}
		$post=array("result"=>$res,"message"=>$rowcount." Records Found","Response"=>1);
		}else{
		$post=array("message"=>"No Records Found","Response"=>0);
			
		}
   		$rdd=$post;

   header("content-type:application/json");
   print_r(json_encode($rdd));
?>