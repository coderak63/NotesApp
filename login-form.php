<?php
    session_start();
    include("server.php");

    if(isset($_POST['login']))
    {

        $email=$_POST['email'];
        $pass=$_POST['password'];
        $password=md5($pass);

        $rs=mysqli_query($conn,"select * from users where email='$email' and password='$password'");
        if(mysqli_num_rows($rs)<1)
        {
            echo '<script>alert("Invalid Username or password.")</script>';
        }
        else
        {
          $_SESSION["login"]=$email;
        }

    }


if(isset($_POST['submit']))
{

  $flag=true;

  $f_name=$_POST['f_name'];
  $l_name=$_POST['l_name'];
  $email=$_POST['email'];
  $pass=$_POST['password'];
  $password=md5($pass);


  $rs=mysqli_query($conn,"select * from users where email='$email'");
if (mysqli_num_rows($rs)>0)
{
    echo '<script>alert("User already exists.")</script>';

}
else{

$query="insert into users(email,first_name,last_name,password) values('$email','$f_name','$l_name','$password')";
$rs=mysqli_query($conn,$query)or die("Could Not Perform the Query");

 echo '<script>alert("Account created successfully.\nGo to Login Page")</script>';
 }

}





    if (isset($_SESSION["login"]) )
    {
        header("Location: index.php");
        exit;
    }
  
    
?>




<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="CSS_files/login-form.css">
        <script src="JS_files/login-form.js"></script>
    </head>


    <body style="background-image:url('Images/login-background.jpg');background-size: cover;">
        <div class="container">
            <div class="container form bg-white pt-5 mt-4 mb-3">
                                        
                    <!--change after click on sign up-->

                    
                        
                    <div class="text-center" >
                  <img src="Images/logo_login.png" height="130px" class="color logo-1">
                </div>
            <br>

                <p class="text-center login-heading hide-me">login</p>
                <div class="container hide-me">

                    <form action="" method="post">

                    <div class="row">
                        <div class="col mt-4 pl-5 pr-5">
                        <p class="username">Email</p>
                        <div class="row mt-4">
                            <div class="col-2 text-center pt-1 pr-0">
                                <i class="fa fa-envelope-o" aria-hidden="true" id="user"></i>
                            </div>
                            <div class="col-10 pl-0">
                                <input type="email" name="email" placeholder="Type your email address" class='email' required="true">
                            </div>
                        </div>
                        <hr class="hr-1">
                        <div class="email-hide"></div>
                        </div>
                    </div>

                    

                    <div class="row">
                        <div class="col mt-4 pl-5 pr-5">
                            <p class="username">Password</p>
                            <div class="row mt-4">
                                <div class="col-2 text-center pt-1 pr-0">
                                    <i class="fa fa-lock" aria-hidden="true" id="lock"></i>
                                </div>
                                <div class="col-10 pl-0">
                                    <input type="password" name="password" placeholder="Type your password" class="input-2" required="true" minlength="6">
                                </div>
                            </div>
                            <hr class="hr-2">
                            <div class="hide-1"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-right pr-5">
                            <a href="#"><span class="forget-password">Forget password?</span></a>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col pl-5 pr-5">
                            <input type="submit" class="btn btn-block text-white login-button" name="login" value="Login">
                            
                        
                        </div>
                    </div>

                    </form>
                   

                    <div class="row mt-5">
                        <div class="col text-center">
                            <span style="text-transform: capitalize;font-family: Arial, Helvetica, sans-serif;font-size:15px;font-weight:600;color:rgb(148, 141, 141)">Not a member?</span>
                        </div>
                        <div class="col-12 text-center pt-3">
                            <a href="#"><span class="sign-up">sign up</span></a>
                        </div>
                    </div>
                </div>



                                                                        <!--change it-->
                                                                        
                <p class="text-center login-heading show-me">sign up</p>

                <form action="" method="post">


                <div class="row show-me">
                    <div class="col mt-4 pl-5 pr-5">
                        <p class="username">First name</p>
                        <div class="row mt-4">
                            <div class="col-2 text-center pt-1 pr-0">
                                <i class="fa fa-user-o" aria-hidden="true" id="user"></i>
                            </div>
                            <div class="col-10 pl-0">
                                <input type="text" name="f_name" placeholder="Type your first name" class='first-name' required="true">
                            </div>
                        </div>
                        <hr class="hr-1">
                        <div class="first-name-hide"></div>
                    </div>
                </div>

                <div class="row show-me">
                    <div class="col mt-4 pl-5 pr-5">
                        <p class="username">Last name</p>
                        <div class="row mt-4">
                            <div class="col-2 text-center pt-1 pr-0">
                                <i class="fa fa-user-o" aria-hidden="true" id="user"></i>
                            </div>
                            <div class="col-10 pl-0">
                                <input type="text" name="l_name" placeholder="Type your last name" class='last-name' required="true">
                            </div>
                        </div>
                        <hr class="hr-1">
                        <div class="last-name-hide"></div>
                    </div>
                </div>

                <div class="row show-me">
                    <div class="col mt-4 pl-5 pr-5">
                        <p class="username">Email-ID</p>
                        <div class="row mt-4">
                            <div class="col-2 text-center pt-1 pr-0">
                                <i class="fa fa-envelope-o" aria-hidden="true" id="user"></i>
                            </div>
                            <div class="col-10 pl-0">
                                <input type="email" name="email" placeholder="Type your email address" class='email' required="true">
                            </div>
                        </div>
                        <hr class="hr-1">
                        <div class="email-hide"></div>
                    </div>
                </div>

                <div class="row show-me">
                    <div class="col mt-4 pl-5 pr-5">
                        <p class="username">Password</p>
                        <div class="row mt-4">
                            <div class="col-2 text-center pt-1 pr-0">
                                <i class="fa fa-lock" aria-hidden="true" id="lock"></i>
                            </div>
                            <div class="col-10 pl-0">
                                <input type="password" id="password" name="password" placeholder="Type your password" class="password-signup" required="true" minlength="6">
                            </div>
                        </div>
                        <hr class="hr-2">
                        <div class="password-signup-hide"></div>
                    </div>
                </div>

                <div class="row show-me">
                    <div class="col mt-4 pl-5 pr-5">
                        <p class="username">Confirm-password</p>
                        <div class="row mt-4">
                            <div class="col-2 text-center pt-1 pr-0">
                                <i class="fa fa-lock" aria-hidden="true" id="lock"></i>
                            </div>
                            <div class="col-10 pl-0">
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="Type your password" class="confirm-password-signup" required="true" minlength="6">
                            </div>
                        </div>
                        <hr class="hr-2">
                        <div class="confirm-password-signup-hide"></div>
                    </div>
                </div>

                
                <div class="row mt-4 show-me">
                    <div class="col pl-5 pr-5">
                       <input type="submit" class="btn btn-block text-white signup-button" name="submit" value="Signup">
                   
                    </div>
                </div>

                </form>

                <div class="row mt-5 show-me">
                    <div class="col text-center">
                        <span style="text-transform: capitalize;font-family: Arial, Helvetica, sans-serif;font-size:15px;font-weight:600;color:rgb(148, 141, 141)">Already a member?</span>
                    </div>
                    <div class="col-12 text-center pt-3">
                        <a href="#"><span class="login-page">LOGIN</span></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
