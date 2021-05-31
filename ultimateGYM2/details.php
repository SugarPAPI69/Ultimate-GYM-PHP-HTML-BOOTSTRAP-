<?php
ob_start();
session_start();

include_once 'dbconnect.php';

if (isset($_SESSION['user']) != "") {
    // select logged in user information
    $res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);
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

    // check email exist or not
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
        header("Location: adminlte/index.php");
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

        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    
    .card {
    border: none;
    max-width: 350px;
    border-radius: 15px;
    margin: 20px 0 20px;
    padding: 25px;
    padding-bottom: 10px !important
}

.heading {
    color: #C1C1C1;
    font-size: 34px;
    font-weight: 500
}



.text-warning {
    font-size: 18px;
    font-weight: 500;
    color: #edb537 !important
}

#cno {
    transform: translateY(-10px)
}

input {
    border-bottom: 1.5px solid #E8E5D2 !important;
    
    border-radius: 0;
    border: 0
}

.form-group input:focus {
    border: 0;
    outline: 0
}

.col-sm-5 {
    padding-left: 90px
}
.btn:focus {
    box-shadow: none
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
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#contactModal">Contact</a>
                    </li>
                </ul>
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
                        echo '<a class="nav-link" href="#">'.$userRow['email'].'</a>';
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
        
        $stmt = $conn->prepare("SELECT * FROM class WHERE id = ?");
            $stmt->bind_param("s", $_GET['id']);
            //execute query
            $stmt->execute();
            //get result
            $res = $stmt->get_result();
            $stmt->close();
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        ?>
        <div class="row">
            <div class="col-12">
                <h2 class="bold text-center"><?php echo $row['name'] ?></h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <img src="<?php echo $row['image'] ?>" style="height:auto; width:100%">
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-12">
                        <h4>Class Description</h4>
                        <p class="mt-2"><?php echo $row['details'] ?></p>
                        <hr>
                    </div>
                      <div class="col-12">
                        <h4> Class Trainer </h4>
                        <p class="mt-2">  <?php echo $row['trainer_name']; ?></p>
                        <hr>
                    </div>
                    <div class="col-12">
                        <h4>Class Schedule</h4>
                        <p class="mt-2"><?php echo $row['time_open'] ?></p>
                        <hr>
                    </div>
                     <div class="col-12">
                        <h4>Class Capacity </h4>
                        <p class="mt-2">  <?php echo $row['class_size']; ?></p>
                        <hr>
                    </div>
                    <div class="col-12">
                        <h4>Current Class Capacity </h4>
                        <p class="mt-2">  <?php echo $row['current_class_size']; ?></p>
                        <hr>
                    </div>

                    <div class="col-12">
                        <h4>Price </h4>
                        <p class="mt-2">  <?php echo $row['price']; ?></p>
                        <hr>
                    </div>
                     <div class="col-12">
                        <h4>Class Intensity Level </h4>
                        <p class="mt-2">  <?php echo $row['intensity_Level']; ?></p>
                        <hr>
                    </div>

                   

                    <?php
                        if (!isset($_SESSION['user']) == "") {
                            echo '<div class="col-md-4">';
                            echo '<a href="#" class="btn btn-success btn-block mt-1" data-toggle="modal" data-target="#reservationModal">Sign up</a>';
                            echo '</div>';
                           
                        }
                    ?>        
                </div>
               
            </div>
        </div>
        <hr>
    </div>

   
    <!-- Reservation Modal -->
    <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                 
                  
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
            <div class="card mx-auto">
                <form method="POST" autocomplete="off">
                <h5 class="heading">PAYMENT DETAILS</h5>
                <form class="card-details ">
                    <div class="form-group mb-0">
                        <p class="text-warning mb-0">Card Number</p> <input type="text" name="card_no" placeholder="1234 5678 9012 3457" size="17" id="cno" minlength="19" maxlength="19"> <img src="https://img.icons8.com/color/48/000000/visa.png" width="64px" height="60px" />
                    </div>
                    <div class="form-group">
                        <p class="text-warning mb-0">Cardholder's Name</p> <input type="text" name="card_holderName" placeholder="Name" size="17">
                    </div>
                     <div class="form-group">
                        <p class="text-warning mb-0">Bank Name</p> <input type="text" name="bank_name" placeholder="bank name" size="17">
                    </div>
                    <div class="form-group pt-2">
                        <div class="row d-flex">
                            <div class="col-sm-4">
                                <p class="text-warning mb-0">Expiration</p> <input type="text" name="expiry" placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7">
                            </div>
                            <div class="col-sm-3">
                                <p class="text-warning mb-0">C v v</p> <input type="password" name="cvv" placeholder="&#9679;&#9679;&#9679;" size="3" minlength="3" maxlength="3">

                             
    
                            
                            <div class="col-sm-5 pt-0"> <button type="submit" class="btn btn-primary">   PAY<i class="fas fa-arrow-right px-3 py-2"></i></button> </div>

                             
                
                        </div>
                         
                    </div>

               
            </div>
        </div>
                <center><h5>  **<?php echo $row['price'] ; ?> Pesos Will be Charged on your account</h5></center>
    </div>
</form>
</form>
</div>

</div>
                    
                        <script>
  function clickAlert() {
    alert("Card Credentials will need to be inputted if you continue ");
}
</script>

<center><input style="background:#dddddd !important; border:0 !important" type="button" onclick="clickAlert()" value=" Clear!"></center>


                  

                        </div>
            </div>
        </div>
    </div>


<?php 
 //PAy
    if (isset($_POST['payment'])){
        
        $id = $_POST['payment_id'];
        $card_no = $_POST['card_no'];
        $card_holderName = $_POST['card_holderName'];
        $bank_name = $_POST['bank_name'];
        $cvv = $_POST['cvv'];
        $expiry = $_POST['expiry'];
    

        $conn->query("INSERT INTO payment (id, card_no, card_holderName, bank_name, cvv, expiry) VALUES ('$id', '$card_no', '$card_holderName', '$bank_name', '$cvv', '$expiry')") or die($conn->error);

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: details.php");
}

 ?>
    
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
                        <button type="submit" name="btn-login" class="btn btn-block btn-light bold" style="background:gray !important; border:0 !important">Login</button>
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
                        <button type="submit" name="signup" id="reg" class="btn btn-block btn-light bold" style="background:gray !important; border:0 !important">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- About Modal -->
    <div class="modal fade" id="aboutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">About Us</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                <h4 class="text-center">MEET THE TEAM</h4>
                <img src="" style="height:auto; width:100%">
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