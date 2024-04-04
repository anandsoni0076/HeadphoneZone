<?php

require_once "connection.php";
if (isset($_POST['register'])) {

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPass'];
    $mobileNo = $_POST['mobileNo'];

    $sql_query = mysqli_query($conn, "SELECT * FROM users1 WHERE email = '$email'") or die('Query failed');

    if (mysqli_num_rows($sql_query) > 0) {
        $msg[] = 'User already exists!';
    } else {
        if ($password != $confirmPass) {
            $msg[] = 'Confirm password does not match!';
        } else if (strlen($password) < 8) {
            $msg[] = 'Password must be at least 8 characters long.';
        } else if (!preg_match('/[A-Z]/', $password)) {
            $msg[] = 'Password must contain at least one capital letter.';
        } else if (!preg_match('/\d/', $password)) {
            $msg[] = 'Password must contain at least one digit.';
        } else {
            mysqli_query($conn, "INSERT INTO `users1`(firstname, lastname, email, password, mobileNo) VALUES('$fname', '$lname', '$email', '$password', '$mobileNo')") or die('Query failed');
            $msg[] = 'Registered successfully!';
            header('location: LoginForm.php');
        }
    }
}
?>
<html>

<head>
<script src="https://kit.fontawesome.com/de5a643238.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <title>Registration Form</title>

</head>

<body>
    <?php
    if (isset($msg)) {
        if (is_array($msg)) {
            foreach ($msg as $msg) {
                echo "
                <div id='messageBox'>
          <span class='closeButton' onclick='this.parentElement.remove()'>&times;</span>
          <p>$msg</p>
        </div>";
            }
        }
    }
    ?>
    <div class="container">
        <div class="form">
            <span class="loginTitle">Registration</span>
            <form action="signup.php" method="post">
                <div class="inputForm">
                    <input type="text" placeholder="Enter your First name" id="firstname" name="firstname" required>
                </div>
                <div class="inputForm">
                    <input type="text" placeholder="Enter your Last name" id="lastname" name="lastname" required>
                </div>
                <div class="inputForm">
                    <input type="email" placeholder="Enter your email" id="email" name="email" required>
                </div>
                <div class="inputForm">
                    <input type="password" placeholder="Enter your password" id="password" name="password" required>
                </div>
                <div class="inputForm">
                    <input type="password" placeholder="Confirm password" id="confirmPass" name="confirmPass" required>
                </div>
                <div class="inputForm">
                    <input type="text" placeholder="Enter mobile number" id="mobileNo" maxlength="10" name="mobileNo" required>
                </div>
                <div class="loginBtn">
                    <input type="submit" name="register" value="Register">
                </div>
            </form>
            <div class="sign_up">
                <span>Already a member?
                    <a href="LoginForm.php">Login</a>
                </span>
            </div>
        </div>
    </div>
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
  max-width: 530px;
  width: 100%;
  border-radius: 11px;
  background-color: #ffffff; /* White */
  box-shadow: 0 5px 10px #000000; /* Black */
  position: relative;
}

* {
  padding: 0;
  margin: 0;
}

.container .form {
  padding: 30px;
}

.container .form .loginTitle {
  position: relative;
  font-weight: bolder;
  font-size: 30px;
  font-family: 'Bruno Ace SC', 'sans-serif';
  color: #000000; /* Black */
}

.form .loginTitle::before {
  border-radius: 20px;
  height: 3px;
  width: 50px;
  left: 0;
  bottom: 0;
  background-color: #2CCCC3; /* Light Turquoise */
  content: '';
  position: absolute;
}

.form .inputForm {
  position: relative;
  margin-top: 30px;
  height: 50px;
  width: 100%;
}

.inputForm input {
  width: 100%;
  outline: none;
  height: 100%;
  position: absolute;
  border: none;
  border-bottom: 2px solid #ccc;
  border-top: 2px solid transparent;
  color: #000000; /* Black */
  background-color: #ffffff; /* White */
}

.form .loginBtn input {
  width: 100%;
  height: 30px;
  font-weight: bold;
  border: none;
  border-bottom: 2px solid #ccc;
  border-top: 2px solid transparent;
  outline: none;
  transition: all 0.4s ease;
  border-radius: 10px;
  background-color: #FACD3D; /* Yellow */
  color: #000000; /* Black */
}

.sign_up a {
  text-decoration: none;
  color: #5626C4; /* Purple */
}

.form .loginBtn input:hover {
  background-color: #5626C4; /* Purple */
  color: #ffffff; /* White */
}

.sign_up a:hover {
  color: #E60576; /* Magenta */
}

.loginBtn {
  padding: 10px 0px 10px 0px;
}


    /* msg css starts */
    #messageBox {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #f3f3f3;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        transition: opacity 0.3s ease-in-out;
    }

    #messageBox.show {
        opacity: 1;
    }

    .closeButton {
        float: right;
        cursor: pointer;
        font-size: 24px;
        font-weight: bold;
        color: #888;
    }

    .closeButton:hover {
        color: #000;
    }

    /* Message css end */
</style>