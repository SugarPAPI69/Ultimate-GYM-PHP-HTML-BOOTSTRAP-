<?php
ob_start();
session_start();




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ULTIMATE GYM?</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- To edit -->
    
    <style>
        body {
            background: #dddddd;
            font-family: fantasy;
        }
        
        a {
            color:black;
        }
        a:hover {
            color:gray;
        }
        .img {
            height: 100%;
            width: 100%
        }
        
        .bold {
            font-weight: 80000;
        }
    </style>
</head>

<body>
    <?php 
        if (isset($_SESSION['message'])): ?>
         <div class = "alert alert-<?=$_SESSION['msg_type']?>">
        
        <?php 
         echo $_SESSION['message'];
         unset($_SESSION['message']);
        ?>
         </div>

         <?php endif ?>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <div class="container">
            <a class="navbar-brand d-none d-md-block" href="index.php">
                <img src="images/gym/gym_logo.png" style="height:auto; width:20%">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse bold" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Welcome to the Admin Page</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <br>
    <br>
    <br>
<?php $update = false; ?>

<?php require_once 'dbconnect.php'; ?>
<div class = "container">


     <div class="container">
<div class="row">
        <div class=”row align-items-center”>
            <div class=”col-9 align-self-center”>
            <a href="#" data-toggle="modal" data-target="#ClassModal" class="btn btn-lg btn-primary">Add a Class</a>
             <a href="#" data-toggle="modal" data-target="#ClassModal" class="btn btn-lg btn-primary">Edit Class</a>
             <a href="#" data-toggle="modal" data-target="#TrainerModal" class="btn btn-lg btn-primary">Add a tainer</a>
            <a href="#" data-toggle="modal" data-target="#coverModal" class="btn btn-lg btn-warning">Change cover photos</a>
            <a href="index.php" class="btn btn-lg btn-warning">Logout</a>
          </div>
      </div>
      
 

</div>
</div>
<?php
       $conn = new mysqli($db_host, $db_user, $db_pass, $db_name) or die(mysqli_error($conn));
       $result = $conn->query("SELECT * FROM class") or die($conn->error);



       //pre_r($result);
?>
<br>
<br>
<br>
<h1> Current Class List </h1>
       <div class="row justify-content-center">
            <table class = "table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>details</th>
                        <th>trainer name</th>
                           <th>curr_Date</th>
                        <th>time open</th>
                        <th>class size</th>
                        <th>current size</th>
                        <th>price</th>
                          <th>Intensity Level</th>
                        <th>category</th>
                        
                        <th>email</th>
                        <th colspan="2">action</th>
                    </tr>
                </thead>
        <?php
               while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td> <?php echo $row['id'] ?> </td>
                    <td> <?php echo $row['name'] ?> </td>
                    <td> <?php echo $row['details'] ?> </td>
                    <td> <?php echo $row['trainer_name'] ?> </td>
                    <td> <?php echo $row['curr_Date'] ?> </td>
                    <td> <?php echo $row['time_open'] ?> </td>
                    <td> <?php echo $row['class_size'] ?> </td>
                    <td> <?php echo $row['current_class_size'] ?> </td>
                    <td> <?php echo $row['price'] ?> </td>
                     <td> <?php echo $row['intensity_Level'] ?> </td>
                    <td> <?php echo $row['category'] ?> </td>
                 
                    <td> <?php echo $row['email'] ?> </td>
                    <td>
                        <a href="admin.php?edit=<?php echo $row['id']; ?>"
                            class = "btn btn-info">Edit</a>
                        <a href="admin.php?delete=<?php echo $row['id']; ?>"
                            class = "btn btn-danger">Delete</a>
                    </td>
                </tr>

        <?php endwhile; ?>


            </table>

       </div>

<?php 
       function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
       }
?>


<?php
       $conne = new mysqli($db_host, $db_user, $db_pass, $db_name) or die(mysqli_error($conn));
       $result = $conn->query("SELECT * FROM trainers") or die($conn->error);
       //pre_r($result);
?>


<br>
<h1> Current Trainer List </h1>
       <div class="row justify-content-center">
            <table class = "table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Trainer First name</th>
                        <th>Trainer Last name</th>
                        <th>Trainer Email</th>
                        <th> Phone Number</th>
                        <th>Expertise</th>
                        <th>image url</th>
                        <th colspan="2">action</th>
                    </tr>
                </thead>
        <?php
               while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td> <?php echo $row['id'] ?> </td>
                    <td> <?php echo $row['fname'] ?> </td>
                    <td> <?php echo $row['lname'] ?> </td>
                    <td> <?php echo $row['email'] ?> </td>
                    <td> <?php echo $row['phone'] ?> </td>
                    <td> <?php echo $row['expertise'] ?> </td>
                    <td> <?php echo $row['images'] ?> </td>
                    <td>
                         <a href="admin.php?updatedatatrainers=<?php echo $row['id']; ?>"
                            class = "btn btn-info" data-toggle="modal" data-target="#TrainerEditModal">Edit</a>
                        <a href="admin.php?delete=<?php echo $row['id']; ?>"
                            class = "btn btn-danger">Delete</a>
                    </td>
                </tr>

        <?php endwhile; ?>


            </table>

       </div>

<?php
       $conn = new mysqli($db_host, $db_user, $db_pass, $db_name) or die(mysqli_error($conn));
       $result = $conn->query("SELECT * FROM users") or die($conn->error);
       //pre_r($result);
?>


<br>
<h1> Current User List </h1>
       <div class="row justify-content-center">
            <table class = "table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>User First name</th>
                        <th>User Last name</th>
                        <th>USer Email</th>
                        <th> Phone Number</th>
                        <th colspan="2">action</th>
                    </tr>
                </thead>
        <?php
               while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td> <?php echo $row['id'] ?> </td>
                    <td> <?php echo $row['firstname'] ?> </td>
                    <td> <?php echo $row['lastname'] ?> </td>
                    <td> <?php echo $row['email'] ?> </td>
                    <td> <?php echo $row['phone'] ?> </td>
                    <td>
                        <a href="admin.php?delete=<?php echo $row['id']; ?>"
                            class = "btn btn-danger">Delete</a>
                    </td>
                </tr>

        <?php endwhile; ?>


            </table>

       </div>



    <!-- Add Class Modal -->
  <div class="modal fade" id="ClassModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add a class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row justify-content-center">
<form action="dbconnect.php" method="POST">
  
    <div class="form-group">
        <label>NAME</label>
        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter name">
        </div>
    <div class="form-group">
        <label>DETAILS</label>
        <input type="text" name="details" class="form-control" value="<?php echo $details; ?>" placeholder="Enter details">
        </div>
    <div class="form-group">
        <label>TRAINER NAME</label>
        <input type="text" name="trainer_name" class="form-control" value="<?php echo $trainer_name; ?>" placeholder="Enter trainer name">
        </div>
     <div class="form-group">
         <p>Enter the date and time for your reservation.</p>
         <input type="datetime-local" name="curr_Date" class="form-control" value="<?php echo $curr_Date; ?>"required/>

    <div class="form-group">
        <label>TIME OPEN</label>
        <input type="text" name="time_open" class="form-control" value="<?php echo $time_open; ?>" placeholder="Enter time open">
        </div>
    <div class="form-group">
        <label>CLASS SIZE</label>
        <input type="text" name="class_size" class="form-control" value="<?php echo $class_size; ?>" placeholder="Enter class size">
        </div>
    <div class="form-group">
        <label>CURRENT CLASS SIZE</label>
        <input type="text" name="current_class_size" class="form-control" value="<?php echo $current_class_size; ?>" placeholder="Enter current class size">
        </div>
         <div class="form-group">
        <label>PRICE</label>
        <input type="number" step="any "name="price" class="form-control" value="<?php echo $price; ?>" placeholder="Enter class price">
        </div>
         <p class="mb-0 mt-1">Intensity Level</p>
                            <select class="form-control" name="intensity_Level"  value="<?php echo $intensity_Level; ?>" required>
                                <option value="1">Level 1</option>
                                <option value="2">Level 2</option>
                                <option value="3">Level 3</option>
                                <option value="4">Level 4</option>
                                <option value="5">Level 5</option>
                               </select>


         <p class="mb-0 mt-1">Class Category</p>
                            <select class="form-control" name="category"  value="<?php echo $category; ?>" required>
                                <option value="Yoga">Yoga</option>
                                <option value="Zumba">Zumba</option>
                                <option value="Boxing">Boxing</option>
                                <option value="Kick Boxing">Kick Boxing</option>
                               </select>
    <div class="form-group">
        <label>IMAGE</label>
        <input type="text" name="image" class="form-control" value="<?php echo $image; ?>" placeholder="Enter image">
        </div>
    <div class="form-group">
        <label>EMAIL</label>
        <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Enter email">
        </div>
    <div class="form-group">
        <?php 
        if ($update == true):
        ?>
        <button type="submit" class="btn btn-info" name="update">Update</button>
        <?php else: ?>
        <button type="submit" class="btn btn-primary" name="save">Save</button>
    <?php endif; ?>
    </div>
            
</form>
</div>
</div>
</div>
</div>
</div>

<!--end of modal-->

    <!-- Add Trainer- Modal -->
  <div class="modal fade" id="TrainerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add a Trainer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" autocomplete="off">
                        <div class="form-group">
                            <p class="mb-0">Trainer First Name</p>
                            <input type="text" class="form-control" name="fname" placeholder="Write here..." required/>
                            <p class="mb-0">Trainer Last Name</p>
                            <input type="text" class="form-control" name="lname" placeholder="Write here..." required/>
                            <p class="mb-0 mt-1">Trainer Email</p>
                            <textarea type="text" class="form-control" name="email" placeholder="Email of the Trainer" required></textarea>
                            <p class="mb-0 mt-1">Trainer contact number</p>
                            <textarea type="number" class="form-control" name="phone" placeholder="Enter The Trainers number " required></textarea>
                              
                            </div>
							 <p class="mb-0 mt-1">Trainer Expertise</p>
                            <select class="form-control" name="expertise" required>
                                <option value="Yoga">Yoga</option>
                                <option value="Zumba">Zumba</option>
                                <option value="Boxing">Boxing</option>
                                <option value="Kick Boxing">Kick Boxing</option>
                            </select>	

                            <p class="mb-0 mt-1">Trainer photo filepath</p>
                            <input type="text" name="images" class="form-control mt-1" required></input>
                        </div>
                        <hr>
                        <button type="submit" name="trainers"  class="btn btn-block btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
	
    <!-- Edit Trainer- Modal -->
  <div class="modal fade" id="TrainerEditModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit a Trainer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" autocomplete="off">
                        <div class="form-group">
                            <p class="mb-0">Trainer First Name</p>
                            <input type="text" class="form-control" name="fname" placeholder="Write here..." required/>
                            <p class="mb-0">Trainer Last Name</p>
                            <input type="text" class="form-control" name="lname" placeholder="Write here..." required/>
                            <p class="mb-0 mt-1">Trainer Email</p>
                            <textarea type="text" class="form-control" name="email" placeholder="Email of the Trainer" required></textarea>
                            <p class="mb-0 mt-1">Trainer contact number</p>
                            <textarea type="number" class="form-control" name="phone" placeholder="Enter The Trainers number " required></textarea>
                              
                            </div>
							 <p class="mb-0 mt-1">Trainer Expertise</p>
                            <select class="form-control" name="expertise" required>
                                <option value="Yoga">Yoga</option>
                                <option value="Zumba">Zumba</option>
                                <option value="Boxing">Boxing</option>
                                <option value="Kick Boxing">Kick Boxing</option>
                            </select>	

                            <p class="mb-0 mt-1">Trainer photo filepath</p>
                            <input type="text" name="images" class="form-control mt-1" required></input>
                        </div>
                        <hr>
                        <button type="submit" name="updatedatatrainers"  class="btn btn-block btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


     <!-- Change Covers Modal -->
  <div class="modal fade" id="coverModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Covers</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" autocomplete="off">
                        <div class="form-group">
                            <h4><strong>COVER</strong></h3>
                            <input type="text" class="form-control mb-1" name="title" placeholder="Title" required/>
                            <input type="text" class="form-control mb-1" name="description" placeholder="Description" required/>
                            <input type="text" class="form-control" name="image" placeholder="Image path" required/>
                        </div>
                        <hr>
                        <button type="submit" name="cover1" id="reg" class="btn btn-primary">Change Cover 1</button>
                        <button type="submit" name="cover2" id="reg" class="btn btn-primary">Change Cover 2</button>
                        <button type="submit" name="cover3" id="reg" class="btn btn-primary">Change Cover 3</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php
   //change covers
      if (isset($_POST['cover1'])) {
        $stmts = $conn->prepare("UPDATE `cover` SET `title`= ?,`description`= ?,`image`=? WHERE id = 1");
        $stmts->bind_param("sss", $_POST['title'], $_POST['description'], $_POST['image']);
        $res = $stmts->execute();
        $stmts->close();
      }
      if (isset($_POST['cover2'])) {
        $stmts = $conn->prepare("UPDATE `cover` SET `title`= ?,`description`= ?,`image`=? WHERE id = 2");
        $stmts->bind_param("sss", $_POST['title'], $_POST['description'], $_POST['image']);
        $res = $stmts->execute();
        $stmts->close();
      }
      if (isset($_POST['cover3'])) {
        $stmts = $conn->prepare("UPDATE `cover` SET `title`= ?,`description`= ?,`image`=? WHERE id = 3");
        $stmts->bind_param("sss", $_POST['title'], $_POST['description'], $_POST['image']);
        $res = $stmts->execute();
        $stmts->close();
      }

       //Add a Trainer
	if (isset($_POST['trainers'])){
		
		$id = $_POST['id'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$expertise = $_POST['expertise'];
		$images = $_POST['images'];
	

		$conn->query("INSERT INTO trainers (id, fname, lname, email, phone, expertise, images) VALUES ('$id', '$fname', '$lname', '$email', '$phone', '$expertise', '$images')") or die($conn->error);

		$_SESSION['message'] = "Record has been saved!";
		$_SESSION['msg_type'] = "success";

		header("location: admin.php");
}


	//EDIT trainer
    if(isset($_POST['updatedatatrainers'])){

        $id = $_POST['id'];
        $fname= $_POST['fname'];  
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $expertise=$_POST['expertise'];
        $images=$_POST['images'];
		
		$conn->query("UPDATE trainers SET fname= '$fname', lname='$lname', email= '$email' , phone = '$phone' , expertise = '$expertise' ,  images= '$images' WHERE id='$id'") or die($conn->error);
       
		$_SESSION['message'] = "Record has been saved!";
		$_SESSION['msg_type'] = "success";

		header("location: admin.php");
	}

	//DELETE trainer
	if (isset($_GET['delete'])){
	$id = $_GET['delete'];
	$conn->query("DELETE FROM trainers WHERE id=$id") or die($conn->error());

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";

	header("location: admin.php");
}

	//DELETE users
	if (isset($_GET['delete'])){
	$id = $_GET['delete'];
	$conn->query("DELETE FROM users WHERE id=$id") or die($conn->error());

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";

	header("location: admin.php");
}
?>






</body>




