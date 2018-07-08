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
	
	//---Get all posted data-----------------
	   $DeviceID=$_POST['DeviceID'];   
	   $DeviceName=isset($_POST['DeviceName'])?$_POST['DeviceName']:'';   
	   $BatteryStatus=isset($_POST['BatteryStatus'])?$_POST['BatteryStatus']:'';   
	   $Longitude=isset($_POST['Longitude'])?$_POST['Longitude']:'';   
	   $Latitude=isset($_POST['Latitude'])?$_POST['Latitude']:'';   
   
     
   /*------------------------------------------------------------------------------*/
   $sql="SELECT * FROM `register` WHERE `DeviceID`='$DeviceID'";  //Check for DeviceID existance in database
   $record=$conn->query($sql);
   $rowcount=$record->rowCount();
   
   $post=array();
   if($rowcount >= 1){
   	
   		$r["re"]="DeviceId Already Existed in Database"; 
   		$post=array("result"=>$r["re"],"Response"=>2);   //Response '2' for existed record
   		$rdd=$post;
   
		header("content-type:application/json");
		print_r(json_encode($rdd));
   	
   }else{
   	
   		$sql="INSERT INTO `register`(`DeviceID`, `DeviceName`, `BatteryStatus`, `Longitude`, `Latitude`) VALUES('$DeviceID','$DeviceName','$BatteryStatus','$Longitude','$Latitude')";  //Insert Record, if not existed
		
   		$record1=$conn->exec($sql);
		
   	    $r["re"]="User Registered Successfully"; 
        $post=array("result"=>$r["re"],"Response"=>1);   //Response '1' for successfully inserted record
   		$rdd=$post;

   
		header("content-type:application/json");
		print_r(json_encode($rdd));
   }			
   ?>