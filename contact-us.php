<?php 
@include('connection.php');
session_start();

if(isset($_POST['submit'])){
    if(isset($_SESSION['userid'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $user_msg = $_POST['users_msg'];
        $user_id = $_SESSION['userid'];
        $query = mysqli_query($conn, "INSERT INTO messages(user_id, name, email, messages) VALUES($user_id, '$name', '$email', '$user_msg')") or die('query failed');
        $msg[] = "message sent successfully";
    }
    else{
        header("location:loginForm.php");
    }
}

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/contact_us.css">
    <title>Contact Us</title>
</head>
<body>

    <section class="contact">
        <div class="contact_form">
            <h1>Contact <span>Us</span></h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, aliquam!</p>
    <form action="" method="post">
        <input type="text" name="name" id="name" placeholder="Enter your name" required>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>
        <textarea name="users_msg" id="users_msg" cols="30" rows="10" placeholder="Your Message "></textarea>
        <input type="submit" name="submit" id="submit" class="btn" placeholder="Enter your submit" required>
    </form>
        </div>

        <div class="contact-image">
            <img src="images/contact_bg3.png" alt="background">
        </div>
    </section>

    <footer>
        <?php @include('footer.php');?>
    </footer>
</body>
</html>
<style>
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
