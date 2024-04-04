<?php
session_start();
include("connection.php");

// Check if the Login form is submitted
if (isset($_POST['Login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "select * from users1 where email='$email'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] === $_POST['password']) {
            if ($row['user_type'] == 'user') {
                $_SESSION['userfname'] = $row['firstname'];
                $_SESSION['useremail'] = $row['email'];
                $_SESSION['userMobile'] = $row['mobileNo'];
                $_SESSION['userlname'] = $row['lastname'];
                $_SESSION['userid'] = $row['id'];
                header('location: welcome.php');
            } elseif ($row['user_type'] == 'admin') {
                $_SESSION['adminname'] = $row['firstname'];
                $_SESSION['adminemail'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header('location: Admin.php');
            }
        } else {
            $error_message = "Invalid password";
        }
    } else {
        $error_message = "Invalid username";
    }
}
?>

<html>

<head>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <script src="jquery.js"></script>
    <title>Login Form</title>
</head>

<body>
    <div class="container">
        <div class="form">
            <span class="loginTitle">Login</span>
            <form action="" method="post">
                <!-- Error message display -->
                <?php if (isset($error_message)): ?>
                    <div class="error-message">
                        <?php echo $error_message; ?>
                        <button type="button" class="close-btn" onclick="hideErrorMessage()">&times;</button>
                    </div>
                <?php endif; ?>

                <div class="inputForm">
                    <input type="text" placeholder="Enter your email" name="email" required>
                </div>
                <div class="inputForm">
                    <input type="password" placeholder="Enter your password" name="password" required>
                </div>
                <div class="signup">
                <span>Not a member?
                    <a href="forgotPass.php">forgot password</a>
                </span>
            </div>
                <div class="loginBtn">
                    <input type="submit" name="Login" value="Login Now">
                </div>
            </form>
            <div class="signup">
                <span>Not a member?
                    <a href="signup.php">Sign up</a>
                </span>
            </div>
        </div>
    </div>

    <script>
        function hideErrorMessage() {
            var errorMessage = document.querySelector('.error-message');
            errorMessage.style.display = 'none';
        }
    </script>
</body>


</html>
<style>
body {
  justify-content: center;
  background-color: #181818; /* Charcoal */
  display: flex;
  height: 100vh;
  align-items: center;
}

.container {
  max-width: 430px;
  width: 100%;
  border-radius: 11px;
  background-color: #ffffff; /* White */
  box-shadow: 0 5px 10px #000000; /* Black */
  position: relative;
}

* {
  margin: 0;
  padding: 0;
}

.container .form {
  padding: 30px;
}

.container .form .loginTitle {
  position: relative;
  font-weight: bolder;
  font-size: 35px;
  font-family: 'Bruno Ace SC', 'sans-serif';
  color: black;
}

.form .loginTitle::before {
  border-radius: 20px;
  height: 3px;
  width: 30px;
  left: 0;
  bottom: 0;
  background-color: #2CCCC3; /* Light Turquoise */
  content: '';
  position: absolute;
}

.form .inputForm {
  margin-top: 30px;
  position: relative;
  height: 50px;
  width: 100%;
}

.inputForm input {
  outline: none;
  height: 100%;
  position: absolute;
  width: 100%;
  border: none;
  border-bottom: 2px solid #ccc;
  border-top: 2px solid transparent;
  color: #000000; /* Black */
  background-color: #ffffff; /* White */
}

.form .loginBtn input {
  height: 30px;
  font-weight: bold;
  border: none;
  width: 100%;
  border-bottom: 2px solid #ccc;
  border-top: 2px solid transparent;
  outline: none;
  transition: all 0.4s ease;
  border-radius: 10px;
  background-color: #FACD3D; /* Yellow */
  color: #000000; /* Black */
}

.loginBtn {
  padding: 10px 0px 10px 0px;
}

.signup a {
  text-decoration: none;
  color: #5626C4; /* Purple */
}

.form .loginBtn input:hover {
  background-color: #5626C4; /* Purple */
  color: #ffffff; /* White */
}

.signup a:hover {
  text-decoration: underline;
  color: #E60576; /* Magenta */
}

.form .signup {
  text-align: center;
}

    </style>
