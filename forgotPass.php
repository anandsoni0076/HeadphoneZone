<?php
session_start();
include("connection.php");

if (isset($_POST['reset_request'])) {
  $email = $_POST['email'];
  $user_id = $_POST['user_id'];

  $result = mysqli_query($conn, "SELECT * FROM users1 WHERE email='$email' AND id='$user_id'");

  if (mysqli_num_rows($result) > 0) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $temp_password = substr(str_shuffle($characters), 0, 6);
    mysqli_query($conn, "UPDATE users1 SET password='$temp_password' WHERE email='$email'");

    $message = $temp_password;
  } else {
    $message = "Invalid email or user ID.";
  }
}

?>

<html>

<head>
  <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
  <script src="jquery.js"></script>
  <title>Login Form</title>
</head>

<body>
  <div class="container">
    <div class="form">
      <span class="loginTitle">Forgot Password</span>
      <form action="" method="post">
        <!-- Error message display -->
        <?php if (isset($message)) : ?>
          <div class='order-message-container'>
            <div class='message-container'>
              <?php
              if (mysqli_num_rows($result) > 0) {
                echo "
                <div class='order-detail'>
                <span>'Your temporary password:'</span>
                <span class='total'>$message</span>
              </div>
                <a href='loginForm.php' class='btn'>Login</a>";
              } else {
                echo " 
                <div class='order-detail'>
                <span class='total'>$message</span>
              </div>
                <a href='forgotPass.php' class='btn'>ok</a>";
              }
              ?>
            </div>
          </div>
        <?php endif; ?>

        <div class="inputForm">
          <input type="text" placeholder="Enter your email" name="email" required>
        </div>
        <div class="inputForm">
          <input type="text" placeholder="Enter your user id" name="user_id" required>
        </div>
        <div class="loginBtn">
          <input type="submit" name="reset_request" value="Check">
        </div>
      </form>
      <div class="signup">
        <span>Not a member?
          <a href="loginForm.php">Login</a>
        </span>
      </div>
    </div>
  </div>

  <script>
    function hideMessage() {
      var errorMessage = document.querySelector('.error-message');
      errorMessage.style.display = 'none';
    }
  </script>
</body>


</html>
<style>
  @import url('css/colorCodes.css');

  body {
    justify-content: center;
    background-color: #181818;
    /* Charcoal */
    display: flex;
    height: 100vh;
    align-items: center;
  }

  .container {
    max-width: 430px;
    width: 100%;
    border-radius: 11px;
    background-color: #ffffff;
    /* White */
    box-shadow: 0 5px 10px #000000;
    /* Black */
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
    background-color: #2CCCC3;
    /* Light Turquoise */
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
    color: #000000;
    /* Black */
    background-color: #ffffff;
    /* White */
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
    background-color: #FACD3D;
    /* Yellow */
    color: #000000;
    /* Black */
  }

  .loginBtn {
    padding: 10px 0px 10px 0px;
  }

  .signup a {
    text-decoration: none;
    color: #5626C4;
    /* Purple */
  }

  .form .loginBtn input:hover {
    background-color: #5626C4;
    /* Purple */
    color: #ffffff;
    /* White */
  }

  .signup a:hover {
    text-decoration: underline;
    color: #E60576;
    /* Magenta */
  }

  .form .signup {
    text-align: center;
  }

  .order-message-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 999;
  }

  .message-container {
    background-color: var(--charcoal-color);
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
    max-width: 80%;
  }

  /* Style for the heading and total price */
  .message-container h3 {
    font-size: 24px;
    color: var(--cyan-color);
    margin-bottom: 10px;
  }

  .order-detail {
    margin-bottom: 20px;
  }

  .order-detail span {
    display: block;
    font-size: 16px;
    color: var(--light-silver-color);
  }

  .order-detail .total {
    font-size: 18px;
    color: var(--cyan-color);

  }

  /* Style for customer details */
  .customer-details p {
    font-size: 16px;
    color: var(--light-silver-color);
    margin-bottom: 10px;
  }

  .customer-details span {
    font-weight: 600;
    color: var(--cyan-color);
  }

  /* Style for the "Continue Shopping" button */
  .btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: var(--cyan-color);
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease;
  }

  .btn:hover {
    color: black;
    transform: scale(1.05);
    transition: ease-in 0.2s;
  }

  /* Media query for smaller screens */
  @media screen and (max-width: 768px) {
    .message-container {
      max-width: 90%;
    }
  }
</style>