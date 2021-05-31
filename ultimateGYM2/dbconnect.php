<?php

if(!isset($_SESSION))
{
session_start();
}

$db_host = "";
$db_name = "ultimate";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);


$id = '';
$name = '';
$details = '';
$trainer_name = '';
$time_open = '';
$class_size = '';
$current_class_size = '';
$category = '';
$image = '';
$email = '';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if (isset($_POST['save'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$details = $_POST['details'];
	$trainer_name = $_POST['trainer_name'];
	$time_open = $_POST['time_open'];
	$class_size = $_POST['class_size'];
	$current_class_size = $_POST['current_class_size'];
	$category = $_POST['category'];
	$image = $_POST['image'];
	$email = $_POST['email'];


$conn->query("INSERT INTO class (id, name, details, trainer_name, time_open, class_size, current_class_size, category, image, email) VALUES ('$id', '$name', '$details', '$trainer_name', '$time_open', '$class_size', '$current_class_size', '$category', '$image', '$email')") or die($conn->error);

    $_SESSION['message'] = "Record has been saved!";
	$_SESSION['msg_type'] = "success";

	header("location: admin.php");
}


if (isset($_GET['delete'])){
	$id = $_GET['delete'];
	$conn->query("DELETE FROM class WHERE id=$id") or die($conn->error());

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";

	header("location: admin.php");
}

if (isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;
	$result = $conn->query("SELECT * FROM class WHERE id = $id") or die($conn->error());
	if (array($result)!==null){
		$row = $result->fetch_array();
		$id = $row['id'];
		$name = $row['name'];
		$details = $row['details'];
	    $trainer_name = $row['trainer_name'];
	    $time_open = $row['time_open'];
	    $class_size = $row['class_size'];
	    $current_class_size = $row['current_class_size'];
	    $category = $row['category'];
	    $image = $row['image'];
	    $email = $row['email'];
	}
}

if (isset($_POST['update'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$details = $_POST['details'];
	$trainer_name = $_POST['trainer_name'];
	$time_open = $_POST['time_open'];
	$class_size= $_POST['class_size'];
	$current_class_size = $_POST['current_class_size'];
	$category = $_POST['category'];
	$email = $_POST['email'];

$conn->query("UPDATE class SET id='$id', name='$name', details='$details', trainer_name='$trainer_name', time_open='$time_open', class_size='$class_size', current_class_size='$current_class_size', category='$category', email='$email' WHERE 'hiddenID'='$hiddenID'") or die($conn->error);

$_SESSION['message']="Record has been updated!";
$_SESSION['msg_type']="warning";
header('location: admin.php');
}