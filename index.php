<?php
include("tasktrackerdb.php");
$error = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if (isset($_POST['form']) && $_POST['form'] == 'login') {

   $username = mysqli_real_escape_string($connection, $_POST['U-Name-Log']);
   $password = $_POST['U-Pass-Log'];
   $isPasswordCorrect = false;
   $query = "SELECT * FROM users WHERE `UserName` = '$username'";
   $result = mysqli_query($connection, $query);

   if ($username === "" || $password === ""){
      $errorLogin[] = 'Please fill out all the necessary details.';
   } else {
      if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['UserPassword'])) {
               $isPasswordCorrect = true;
               header('location: home.php?id=' . $row['UserID']);
               exit();
            } else {
               $errorLogin[] = 'Password is Wrong';
            }
         }
      } else {
         $errorLogin[] = 'Username is Wrong';
      }

   }

   if (!$isPasswordCorrect && empty($errorLogin)) {
      header('Location: index.php');
      exit();
   }

};

if (isset($_POST['form']) && $_POST['form'] == 'register') {
   $username = mysqli_real_escape_string($connection, $_POST['U-Name']);
   $email = mysqli_real_escape_string($connection, $_POST['U-Email']);
   $query = "SELECT * FROM users WHERE `UserName` = '$username' OR `UserEmail` = '$email'";
   $pass = password_hash($_POST['U-Pass'], PASSWORD_DEFAULT);

   if ($username === "" || $email === "" || $pass === ""){
      $errorRegister[] = 'Please fill out all the necessary details.';
   } else {
      $result = mysqli_query($connection, $query);

      if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
            if ($row['UserName'] === $username) {
               $errorRegister[] = 'Username already exists';
            } else if ($row['UserEmail'] === $email) {
               $errorRegister[] = 'Email already exists!';
            }
         }
      } else {
         $insert = "INSERT INTO users (`UserName`, `UserEmail`, `UserPassword`) VALUES ('$username', '$email', '$pass')";
         mysqli_query($connection, $insert);
         $successRegister[] = 'Account Creation Successful!';
      }
   }

   if (empty($errorRegister)) {
      header('Location: index.php');
      exit();
   }
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Task Tracker | Log in</title>
</head>

<body>

    <div class="container <?php if (!empty($errorRegister)) echo 'active'; ?>" id="container">
        <div class="form-container sign-up">
            <form action="" id="RegisterUser" method="post">
                <h1>Create Account</h1>
                <?php
         
               if (isset($errorRegister)) {
                  foreach ($errorRegister as $message) {
                     echo '<span class="error-message">'.$message.'</span>';               
                  }
               }

               if (isset($successRegister)) {
                  foreach($successRegister as $message) {
                     echo '<span class="success-message">'.$message.'</span>';
                  }
               }
            
            ?>
                <input type="text" id= "U-Name" name="U-Name" placeholder="Username">
                <input type="email" id= "U-Email" name="U-Email" placeholder="Email">
                <input type="password" id= "U-Pass"  name="U-Pass"placeholder="Password">
                <input type="hidden" name="form" value="register">
                <button name="register-user" id="registeruser" type="submit" >Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="" id="LogInUser" method="post">
                <h1>Log In</h1>
                <?php
               
               if (isset($errorLogin)) {
                  foreach ($errorLogin as $message) {
                     echo '<span class="error-message">'.$message.'</span>';
                  }
               }
                  
            ?>
                <input type="username" id= "U-Name-Log" name="U-Name-Log" placeholder="Username">
                <input type="password" id= "U-Pass-Log" name="U-Pass-Log"placeholder="Password">
                <input type="hidden" name="form" value="login">
                <button name="login-user" id="loginuser" type="submit">Log In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Log In Page</h1>
                    <p>Click the button below to log in with your personal details</p>
                    <button class="hidden" id="login">Log In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Register Page</h1>
                    <p>Click the button below to register with your personal details</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>