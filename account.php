<?php
session_start();
$user_id = $_SESSION['userid'];
if (!isset($user_id)) {
    header('location: LoginForm.php');
}
?>

<html>

<head>
    <title>Account</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: black;
        color: #E1E2E2;
        /* Light Silver */
    }

    .navbar {
        background-color: #181818;
        /* Black */
        overflow: hidden;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 2;
        display: flex;
        justify-content: center;
        /* Center the elements horizontally */
    }

    .navbar a {
        float: left;
        color: #E1E2E2;
        /* Light Silver */
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
        font-weight: bold;
    }

    .navbar a:hover {
        /* provide colors */
        color: #000000;
        /* Black */
        background-color: #2CCCC3;
        /* Light Turquoise */
    }

    /* Styling for the main element */
    .main {
        position: fixed;
        /* Fixed position on the screen */
        top: 100px;
        /* 100 pixels from the top */
        left: 50%;
        /* Centered horizontally */
        transform: translate(-50%, -50%);
        /* Further centering for both axes */
        padding: 10px;
        /* Padding around the content */
        color: #E60576;
        /* Text color (Magenta) */
        z-index: 1;
        /* Layering order */
        text-align: center;
        /* Center align text */
    }
</style>

<body>
    <div class="navbar">
        <a href="welcome.php" target="_self">HOME</a>
        <a href="myorders.php" target="_self">MY ORDERS</a>
        <a href="profile.php" target="_self">MY PROFILE</a>
        <a href="password.php" target="_self">CHANGE PASSWORD</a>
        <a href="logout.php">LOGOUT</a>
    </div>

    <div class="main">
        <h2>Hello <?php echo $_SESSION['userfname']; ?></h2>
    </div>
</body>

</html>