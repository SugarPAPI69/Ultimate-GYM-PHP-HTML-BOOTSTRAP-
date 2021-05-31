
 	<?php

// php code to Update data from mysql database Table

if(isset($_POST['updatedata']))
{
    
   $hostname = "localhost";
   $username = "root";
   $password = "";
   $databaseName = "ultimate";
   
   $connect = mysqli_connect($hostname, $username, $password, $databaseName);
   
   // get values form input text and number
   
   $id = $_POST['update_id'];
   $name = $_POST['name'];
  $trainer_name=$_POST['trainer_name'];
 		$time_open=$_POST['time_open'];
 		$class_size=$_POST['class_size'];
 		$current_class_size=$_POST['current_class_size']
   // mysql query to Update data
   $query = "UPDATE `class` SET `fname`='".$fname."',`lname`='".$lname."',`age`= $age WHERE `id` = $id";
   
   $result = mysqli_query($connect, $query);
   
   if($result)
   {
       echo 'Data Updated';
   }else{
       echo 'Data Not Updated';
   }
   mysqli_close($connect);
}

?>

