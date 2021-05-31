<?php
ob_start();
session_start();

include_once 'dbconnect.php';

if (isset($_SESSION['users']) != "") {
    // select logged in user information
    $res = $conn->query("SELECT * FROM users WHERE user_id=" . $_SESSION['users']);
    $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
}

//registration
if (isset($_POST['signup'])) {

    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $phone = trim($_POST['phone']); // get posted data and remove whitespace
    $email = trim($_POST['email']);
    $upass = trim($_POST['pass']);

    // hash password with SHA256;
    $password = hash('sha256', $upass);

     $stmt = $conn->prepare("SELECT email FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $count = $result->num_rows;

    if ($count == 0) { // if email is not found add user

        $stmts = $conn->prepare("INSERT INTO users(email,password,firstname,lastname,phone) VALUES(?, ?, ?, ?, ?)");
        $stmts->bind_param("sssss", $email, $password, $firstname, $lastname, $phone);
        $res = $stmts->execute();//get result
        $stmts->close();

        $user_id = mysqli_insert_id($conn);
        if ($user_id > 0) {
            $_SESSION['user'] = $user_id; // set session and redirect to index page
            if (isset($_SESSION['user'])) {
                print_r($_SESSION);
                header("Location: index.php");
                exit;
            }

        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, please try again.";
        }

    } else {
        $errTyp = "warning";
        $errMSG = "Email is already used.";
    }

}

//login
if (isset($_POST['btn-login'])) {
    if($_POST['email'] == "admin@ultimate.com"){
        header("Location: admin.php");
    }else{
        $email = $_POST['email'];
        $upass = $_POST['pass'];
    
        $password = hash('sha256', $upass); // password hashing using SHA256
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email= ?");

        if($stmt == FALSE){
            $errMSG = "User not found!";
        }else{
            $stmt->bind_param("s", $email);
            //execute query
            $stmt->execute();
            //get result
            $res = $stmt->get_result();
            $stmt->close();
        
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        
            $count = $res->num_rows;
            if ($count == 1 && $row['password'] == $password) {
                $_SESSION['user'] = $row['id'];
                header("Location: index.php");
            } elseif ($count == 1) {
                $errMSG = "Bad password!";
            } else $errMSG = "User not found!";
        }
    }
}
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
    <style>
        body {
           background: #DDDDDD;
            font-family: fantasy;
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php">Gym Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="trainer_details.php" >Trainers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#contactModal">Contact Us</a>
                    </li>
                </ul>
                <style>
                
                </style>
                <ul class="navbar-nav ml-auto">
                    <?php
                    if (isset($_SESSION['user']) == "") {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="#" data-toggle="modal" data-target="#registerModal">Register</a>';
                        echo '</li>';
                    }else{
                        echo '<li class="nav-item">';
                       
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="logout.php?logout">Logout</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top:30px">
        <!-- Check if there's an error -->
        <?php
        if (isset($errMSG)) {

            ?>
            <div class="form-group">
                <div class="alert alert-danger text-center">
                    <?php echo $errMSG; ?>
                </div>
            </div>
            <?php
        }
        ?>
        <!-- Greet the user when login -->
        
       
        
        <!-- Dishes carousel -->
        <h2 class="bold" style="color: black">YOUR ULTIMATE GYM</h2>
        <hr>
        <div class="row">
            <div class="col-12">
                <div id="dish" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <li data-target="#dish" data-slide-to="0" class="active"></li>
                        <li data-target="#dish" data-slide-to="1"></li>
                        <li data-target="#dish" data-slide-to="2"></li>
                    </ul>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                                <?php

                                $stmt = $conn->prepare("SELECT * FROM cover WHERE id = 1");
                                //execute query
                                $stmt->execute();
                                //get result
                                $res = $stmt->get_result();
                                $stmt->close();
                                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

                                echo '<img class="img" src="'.$row["image"].'" width="1100" height="500">';
                                echo '<div class="carousel-caption">';
                                echo "<h3>".$row["title"]."</h3>";
                                echo "<p>".$row["description"]."</p>";

                                ?>
                                <br>
                            </div>
                        </div>
                        <div class="carousel-item">
                        <?php

                        $stmt = $conn->prepare("SELECT * FROM cover WHERE id = 2");
                        //execute query
                        $stmt->execute();
                        //get result
                        $res = $stmt->get_result();
                        $stmt->close();
                        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

                        echo '<img class="img" src="'.$row["image"].'" width="1100" height="500">';
                        echo '<div class="carousel-caption">';
                        echo "<h3>".$row["title"]."</h3>";
                        echo "<p>".$row["description"]."</p>";

                        ?>
                                <br>
                            </div>
                        </div>
                        <div class="carousel-item">
                        <?php

                            $stmt = $conn->prepare("SELECT * FROM cover WHERE id = 3");
                            //execute query
                            $stmt->execute();
                            //get result
                            $res = $stmt->get_result();
                            $stmt->close();
                            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

                            echo '<img class="img" src="'.$row["image"].'" width="1100" height="500">';
                            echo '<div class="carousel-caption">';
                            echo "<h3>".$row["title"]."</h3>";
                            echo "<p>".$row["description"]."</p>";

                            ?>
                                <br>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#dish" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#dish" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Restaurants carousel -->
        <h2 class="bold" style="color: black">POPULAR GYM CLASSES</h2>
        <hr>
        <div class="row">
            <div class="col-12">
                <div id="restaurant" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <li data-target="#restaurant" data-slide-to="0" class="active"></li>
                        <li data-target="#restaurant" data-slide-to="1"></li>
                        <li data-target="#restaurant" data-slide-to="2"></li>
                    </ul>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="img" src="images/restaurants/gymclass1.jpg" alt="Los Angeles" width="auto" height="auto">
                            <div class="carousel-caption">
                                <h3>KICK BOXING</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco  .</p>
                                <br>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="img" src="images/restaurants/gymclass2.jpg" alt="Chicago" width="auto" height="auto">
                            <div class="carousel-caption">
                                <h3>ZUMBA</h3>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</p>
                                <br>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="img" src="images/restaurants/gymclass3.jpg" alt="New York" width="auto" height="auto">
                            <div class="carousel-caption">
                                <h3>BOXING</h3>
                                <p>Be Like Senador Manny . HAPPY NEW YEAR EVERYBODY.</p>
                                <br>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#restaurant" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#restaurant" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login to your account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" autocomplete="off">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" required/>
                            <input type="password" name="pass" class="form-control mt-2" placeholder="Password" required/>
                        </div>
                        <hr>
                        <button type="submit" name="btn-login" class="btn btn-block btn-light bold" style="background:#dddddd !important; border:0 !important">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create an account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" autocomplete="off">
                        <div class="form-group">
                            <input type="text" name="firstname" class="form-control" placeholder="First name" required/>
                            <input type="text" name="lastname" class="form-control mt-1" placeholder="Last name" required/>
                            <input type="text" name="phone" class="form-control mt-1" placeholder="Contact number" required/>
                            <hr>
                            <input type="email" name="email" class="form-control mt-1" placeholder="Email address" required/>
                            <input type="password" name="pass" class="form-control mt-1" placeholder="Password" required/>
                        </div>
                        <hr>
                        <button type="submit" name="signup" id="reg" class="btn btn-block btn-light bold" style="background:#DDDDDD  !important; border:0 !important">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contact Us</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Phone Number: <span class="bold">(0955) 610 9996</span></h6>
                    <h6>Telephone Number: <span class="bold">2727-8701</span></h6>
                 Name:<br> 
            <input type="text" placeholder="Enter your name"  required="required"required><br><br>
       Email: <br>
            <input   type="text" placeholder="Enter your email" required><br><br>
       Message:<br>
           <textarea rows="4" cols="50" name="comment" placeholder="Enter text here..." form="usrform">
</textarea>
            <br>
        Gender:   
             <input type="radio" name="gender" value="male"> Male
            <input type="radio" name="gender" value="female"> Female<br>
            
            
            <a href="#" id="submit" type="submit" onclick="myFunction('submit');" class="btn btn-sm animated-button victoria-four">Submit</a> 
            <a href="#" id="cancel" onclick="myFunction('cancel');"   class="btn btn-sm animated-button victoria-four">Cancel</a> 
           
        
        </form>
        
        
<script>
function myFunction(x) {
    
    if(x == "submit"){
        alert("Message Successfully Sent");
    window.location="#"
    
    }else{
        alert("Message Canceled");
     window.location="#"
   
    }
  
}
</script>
</div>

                </div>
            </div>
        </div>
    </div>


                                    
    <!-- Footer -->
    <div class="jumbotron text-center" style="margin-bottom:0">
        <p>YOUR ULTIMATE GYM Website, Copyright © 2020</p>

    </div>

</body>

</html>