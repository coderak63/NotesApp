<?php

session_start();
include("server.php");


if(!isset($_SESSION['login']))
{
    header("Location: login-form.php");
    exit;
}


$email=$_SESSION['login'];
$f_name;
$l_name;
$sql = "SELECT first_name,last_name FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    
    $f_name=$row["first_name"];
    $l_name=$row["last_name"];
  }
} else {
  echo "Data not found!";
}








if(isset($_POST['update_first_name']))
{
	$userid=$_SESSION['login'];
	$f_name=$_POST['first_name'];
	$sql = "UPDATE users SET first_name='$f_name' WHERE email='$userid'";
	if($conn->query($sql)==FALSE)
		echo "Error updating record: ".$conn->error;
}

if(isset($_POST['update_last_name']))
{
    $userid=$_SESSION['login'];
    $l_name=$_POST['last_name'];
    $sql = "UPDATE users SET last_name='$l_name' WHERE email='$userid'";
    if($conn->query($sql)==FALSE)
        echo "Error updating record: ".$conn->error;
}

if(isset($_POST['update_email']))
{
	$userid=$_SESSION['login'];
    $email=$_POST['email'];

    if($userid!=$email){
     $sql=mysqli_query($conn,"select * from users where email='$email'");
    if (mysqli_num_rows($sql)>0)
    {
        echo '<script>alert("Username already exists.")</script>';

    }else{
        $_SESSION['login']=$email;
        //$email=$_SESSION['login'];
    $sql = "UPDATE users SET email='$email' WHERE email='$userid'";
    //header('Location: index.php');
    if($conn->query($sql)==FALSE){
        echo "Error updating record: ".$conn->error;
    }
    
   }
 }
}







if(isset($_POST['update_password']))
{
	$userid=$_SESSION['login'];
	$oldpw=$_POST['oldpassword'];
	$newpw=$_POST['newpassword'];

	$sql=mysqli_query($conn,"select * from users where email='$userid' and password='$oldpw'");
	if (mysqli_num_rows($sql)>0)
	{
    	$sql = "UPDATE users SET password='$newpw' WHERE email='$userid'";
		if($conn->query($sql)==FALSE)
			echo "Error updating record: ".$conn->error;

	}else{
	echo '<script>alert("Kindly enter correct old password.")</script>';
   }


}


?>



 <?php

    
    $userid=$_SESSION['login'];

   if (!file_exists('dpuploads')) {
    mkdir('dpuploads', 0777, true);
    }

    $flag=false;
    $x="";
    $y="";
   if(isset($_FILES['image']))
   {
      $flag=true;
      
      $file_name = $_FILES['image']['name'];
      $file_tmp =$_FILES['image']['tmp_name'];
      
      
      $ext_array = explode('.',$file_name);
      $ext= end($ext_array);
      $file_ext=strtolower($ext);
      
      $extensions= array("jpeg","jpg","png");
      
      
      if(in_array($file_ext,$extensions)=== true)
      {
         move_uploaded_file($file_tmp,"dpuploads/".$userid.".jpg");
         echo '<script>alert("File uploaded successfully.")</script>';
         
      }
      else{
     
         echo '<script>alert("Only JPEG or PNG files are allowed.")</script>';
      }
      
      
   }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo "$f_name"; ?>'s Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="CSS_files/bootstrap.min.css">
        <script src="JS_files/jquery.min.js"></script>
        <script src="JS_files/popper.min.js"></script>
        <script src="JS_files/bootstrap.min.js"></script>
        <link rel="stylesheet" href="CSS_files/aos.css" />
        <link rel="stylesheet" href="CSS_files/font-awesome.min.css">

        <script> 
          $(function(){
                  $("#header").load("header.php");

                      });
        </script> 
 

    

    <script type="text/javascript">
    	function show_fnameform()
    	{
    		document.getElementById('pname_first').style.display="none";
    		document.getElementById('edit-fname').style.display="none";
    		document.getElementById('form_fname').style.display="block";
    	}

    	function hide_fnameform()
    	{
    		document.getElementById('form_fname').style.display="none";
    		document.getElementById('pname_first').style.display="block";
    		document.getElementById('edit-fname').style.display="block";
    	}

        function show_lnameform()
        {
            document.getElementById('pname_last').style.display="none";
            document.getElementById('edit-lname').style.display="none";
            document.getElementById('form_lname').style.display="block";
        }

        function hide_lnameform()
        {
            document.getElementById('form_lname').style.display="none";
            document.getElementById('pname_last').style.display="block";
            document.getElementById('edit-lname').style.display="block";
        }


    	function show_emailform()
    	{
    		document.getElementById('pemail').style.display="none";
    		document.getElementById('edit-email').style.display="none";
    		document.getElementById('form_email').style.display="block";
    	}

    	function hide_emailform()
    	{
    		document.getElementById('form_email').style.display="none";
    		document.getElementById('pemail').style.display="block";
    		document.getElementById('edit-email').style.display="block";
    	}

    	

    	

    	function show_passwordform()
    	{
    		
    		document.getElementById('edit-password').style.display="none";
    		document.getElementById('form_password').style.display="block";
    	}

    	function hide_passwordform()
    	{
    		
    		document.getElementById('edit-password').style.display="block";
    		document.getElementById('form_password').style.display="none";
    	}

    	 function checkPwEquals()
        {
            var pw1=document.getElementById("newp").value.trim();
            var pw2=document.getElementById("confirmnewp").value.trim();

            if(pw1!=pw2){
                alert("Confirm new password is different than new password.");
                return false;
            }


            return true;
        }

    </script>
</head>
<body>


	<!--header part start-->                
     <div id="header"></div>
    <!--header part end-->



    <div class="container">
    <div class="container form bg-white pt-5 mt-4 mb-3">
                     
                     <br><br>                                      
                <h2><p class="text-center login-heading">Profile</p></h2>
	
	
   
    <div class="wrapper">
       
       <div>
                <center>
                <img src="dpuploads/<?php echo $email.'.jpg'.'?t='.time(); ?>" class="rounded-circle img-thumbnail img-fluid" width="25%" height="25%" alt="Profile picture not available, Kindly upload!">
                </center>

                <br><br>
        
            <div class="form-group">
                <fieldset>
                <legend><label>Upload Profile Picture </label></legend>
                <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" class="form-control" name="image" />
                <input type="submit" class="btn btn-primary" value="Upload" />
                </form>
            </fieldset>
            </div>

        
        

	   		<div class="form-group">
                <fieldset>
                <legend>
                <label>First Name </label></legend>
                <p id="pname_first"><?php echo $f_name;?></p>
                <button id="edit-fname" class="btn btn-warning" onclick="show_fnameform()">Edit</button>
                <form style="display: none;" id="form_fname" action="" method="post">
                <input type="text" name="first_name" class="form-control" required="true" value="<?php echo $f_name; ?>">
                <input type="submit" class="btn btn-primary" name="update_first_name" value="Update">
                <input type="submit" class="btn btn-danger" value="Cancel" onclick="hide_fnameform()">
            	</form>
            </fieldset>
            </div>  

        

            


            <div class="form-group">
                <fieldset>
                <legend>
                <label>Last Name </label></legend>
                <p id="pname_last"><?php echo $l_name;?></p>
                <button id="edit-lname" class="btn btn-warning" onclick="show_lnameform()">Edit</button>
                <form style="display: none;" id="form_lname" action="" method="post">
                <input type="text" name="last_name" class="form-control" required="true" value="<?php echo $l_name; ?>">
                <input type="submit" class="btn btn-primary" name="update_last_name" value="Update">
                <input type="submit" class="btn btn-danger" value="Cancel" onclick="hide_lnameform()">
                </form>
            </fieldset>
            </div> 


            <div class="form-group">
                <fieldset>
                <legend>
                <label>Email </label></legend>
                <p id="pemail"><?php echo $email;?></p>
                <button id="edit-email" class="btn btn-warning" onclick="show_emailform()">Edit</button>
                <form  style="display: none;" id="form_email"  action="" method="post">
                <input type="email" name="email" class="form-control" required="true" value="<?php echo $email; ?>">
                <input type="submit" class="btn btn-primary" name="update_email" value="Update">
                <input type="submit" class="btn btn-danger" value="Cancel" onclick="hide_emailform()">
            	</form>
            </fieldset>
            </div>

            

            

            <div class="form-group">
                <fieldset>
                <legend>
                <label>Password </label></legend>
                <button id="edit-password" class="btn btn-warning" onclick="show_passwordform()">Edit</button>
               
                <form  style="display: none;" id="form_password"  action="" method="post" onsubmit="return checkPwEquals()">
                <input type="password" name="oldpassword" class="form-control" minlength="6" required="true" placeholder="Password">
                <input type="password" name="newpassword" id="newp" class="form-control" minlength="6" required="true" placeholder="New Password">
                <input type="password" name="confirmnewpassword" id="confirmnewp" class="form-control" minlength="6" required="true" placeholder="Confirm New Password">
                <input type="submit" class="btn btn-primary" name="update_password" value="Update">
                <input type="button" class="btn btn-danger" value="Cancel" onclick="hide_passwordform()">
            	</form>
            </fieldset>
            </div> 

       </div>


        
    </div>    



</div>
</div>





    <!--footer-->
     <div id="footer"></div>
      <!--footer-->

      <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

      <script>
            //on scroll plugin//
  AOS.init({
    once:true,
    duration:1000,
  });
  //on scroll plugin//
      </script>

</body>
</html>