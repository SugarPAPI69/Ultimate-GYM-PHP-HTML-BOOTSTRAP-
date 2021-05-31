<?php
ob_start();
session_start();

include_once 'dbconnect.php';

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
    <div class="container">
<div class="row">
        <div class=”row align-items-center”>
            <div class=”col-9 align-self-center”>
            <a href="#" data-toggle="modal" data-target="#ClassModal" class="btn btn-lg btn-primary">Add a Class</a>
             <a href="#" data-toggle="modal" data-target="#TrainerModal" class="btn btn-lg btn-primary">Add a tainer</a>
            <a href="#" data-toggle="modal" data-target="#coverModal" class="btn btn-lg btn-warning">Change cover photos</a>
            <a class="btn btn-lg btn-warning" href="categories.php">Edit</a>
    
            <a href="http://localhost/phpmyadmin/sql.php?server=1&db=ultimate&table=class&pos=0" class="btn btn-lg btn-danger">Delete Class</a>
            <a href="http://localhost/phpmyadmin/sql.php?server=1&db=ultimate&table=users&pos=0" class="btn btn-lg btn-danger">Delete Users</a>
            <a href="index.php" class="btn btn-lg btn-warning">Logout</a>
          </div>
      </div>
      
 

</div>
</div>
            <?php


      //Add a class
      if (isset($_POST['class'])) {
        $stmts = $conn->prepare("INSERT INTO class(name,details,trainer_name,time_open,class_size,current_class_size,category,image,email) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmts->bind_param("sssssssss", $_POST['name'], $_POST['details'], $_POST['trainer_name'], $_POST['time_open'], $_POST['class_size'], $_POST['current_class_size'], $_POST['category'], $_POST['image'], $_POST['email']);
        $res = $stmts->execute();
        $stmts->close();
      }

      //Add a Trainer
      if (isset($_POST['trainers'])) {
        $srp = $conn->prepare("INSERT INTO trainers(id,fname,lname,email,phone,expertise,images) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $srp->bind_param("sssssss", $_POST['id'], $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], 
          $_POST['expertise'], $_POST['images']);
        $result = $srp->execute();
        $srp->close();
      }

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
      
      ?>

   

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
                    <form method="POST" autocomplete="off">
                        <div class="form-group">
                            <p class="mb-0">Class Name</p>
                            <input type="text" class="form-control" name="name" placeholder="Write here..." required/>
                            <p class="mb-0 mt-1">Details</p>
                            <textarea type="text" class="form-control" name="details" placeholder="Brief description of the Class" required></textarea>
                            <p class="mb-0 mt-1">Class Trainer:</p>
                            <textarea type="text" class="form-control" name="trainer_name" placeholder="Enter The Trainers Name " required></textarea>
                          
                            
                              
                            </div>
                            <p class="mb-0 mt-1">Schedule</p>
                            <input type="text" class="form-control" name="time_open" placeholder="At what time will this class occur?" required/>
                            <p class="mb-0 mt-1">Class Size</p>
                             <input type="text" class="form-control" name="class_size" placeholder="Please Enter the Class Size" required/>
                             <p class="mb-0 mt-1">Current Size</p>
                            <input type="text" class="form-control" name="current_class_size" placeholder="Please Enter the Current Class Size" required/>
                            <p class="mb-0 mt-1">Class Category</p>
                            <select class="form-control" name="category" required>
                                <option value="Yoga">Yoga</option>
                                <option value="Zumba">Zumba</option>
                                <option value="Boxing">Boxing</option>
                                <option value="Kick Boxing">Kick Boxing</option>
                               
                            </select>
                            <p class="mb-0 mt-2">Employee email address</p>
                            <input type="email" name="email" class="form-control mt-1" required></input>
                            <p class="mb-0 mt-1">Employee photo filepath</p>
                            <input type="text" name="image" class="form-control mt-1" required></input>
                        </div>
                        <hr>
                        <button type="submit" name="class" id="reg" class="btn btn-block btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!--EDIT CLASS-->   
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit a class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" autocomplete="off">
                        <div class="form-group">
                            <p class="mb-0">Class Name</p>
                            <input type="text" class="form-control" name="name" placeholder="Edit here..." required/>
                            <p class="mb-0 mt-1">Details</p>
                            <textarea type="text" class="form-control" name="details" placeholder="Brief description of the Class" required></textarea>
                            <p class="mb-0 mt-1">Class Trainer:</p>
                            <textarea type="text" class="form-control" name="trainer_name" placeholder="Edit The Trainers Name " required></textarea>
                          
                            
                              
                            </div>
                            <p class="mb-0 mt-1">Schedule</p>
                            <input type="text" class="form-control" name="time_open" placeholder="Edit the time that this class will occur?" required/>
                            <p class="mb-0 mt-1">Class Size</p>
                             <input type="text" class="form-control" name="class_size" placeholder="Edit the Class Size" required/>
                             <p class="mb-0 mt-1">Current Size</p>
                            <input type="text" class="form-control" name="current_class_size" placeholder="Edit the Current Class Size" required/>
                            <p class="mb-0 mt-1">Class Category</p>
                            <select class="form-control" name="category" required>
                                <option value="Yoga">Yoga</option>
                                <option value="Zumba">Zumba</option>
                                <option value="Boxing">Boxing</option>
                                <option value="Kick Boxing">Kick Boxing</option>
                               
                            </select>
                            <p class="mb-0 mt-2">Employee email address</p>
                            <input type="email" name="email" class="form-control mt-1" required></input>
                            <p class="mb-0 mt-1">Employee photo filepath</p>
                            <input type="text" name="image" class="form-control mt-1" required></input>
                        </div>
                        <hr>
                        <button type="submit" name="class" id="reg" class="btn btn-block btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                            <input type="text" class="form-control" name="expertise" placeholder="what type of gym coach are you? Zcoach(Zumba Coach, BCoach?(Boxing Coach), KBCoach?(Kick Boxing Coach), YCoach?(Yoga Coach)" required/>

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

    
   



 </body>
</html>