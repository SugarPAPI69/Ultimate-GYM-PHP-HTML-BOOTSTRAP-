<?php
 $connection = mysqli_connect("localhost", "root", "");
 $db = mysqli_select_db($connection, 'ultimate');


 	if(isset($_POST['deletedata'])){


 		$id = $_POST['delete_id'];
 		


 		$query ="DELETE FROM class WHERE id='$id'  ";
 		$query_run = mysqli_query($connection, $query);

 		if($query_run){
 			echo '<script alert("Data deleted "); </script';
 			header("Location:details.php");
 		}
 		else {
 			echo '<script alert("Data not deleted "); </script';
 		}

 	}
 	?>

