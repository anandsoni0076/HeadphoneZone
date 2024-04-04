<?php
@include('connection.php');
@include('account.php');
if (isset($_POST['submit'])) {
    $newPass = $_POST['new-password'];
    $conPass = $_POST['confirm-password'];
    
    // Password validation checks
    if ($newPass != $conPass) {
        echo "
        <div id='messageBox'>
          <span class='closeButton' onclick='this.parentElement.remove()'>&times;</span>
          <p>Passwords must match.</p>
        </div>";
    } else if (strlen($newPass) < 8) {
        echo "
        <div id='messageBox'>
          <span class='closeButton' onclick='this.parentElement.remove()'>&times;</span>
          <p>Password must be at least 8 characters long.</p>
        </div>";
    } else if (!preg_match('/[A-Z]/', $newPass)) {
        echo "
        <div id='messageBox'>
          <span class='closeButton' onclick='this.parentElement.remove()'>&times;</span>
          <p>Password must contain at least one capital letter.</p>
        </div>";
    } else if (!preg_match('/\d/', $newPass)) {
        echo "
        <div id='messageBox'>
          <span class='closeButton' onclick='this.parentElement.remove()'>&times;</span>
          <p>Password must contain at least one digit.</p>
        </div>";
    } else {
        $sql = mysqli_query($conn, "UPDATE users1 SET password='$newPass' WHERE id=$user_id");
        echo "
        <div id='messageBox'>
          <span class='closeButton' onclick='this.parentElement.remove()'>&times;</span>
          <p>Password updated successfully.</p>
        </div>";
    }
}
?>

<html>

<head>
    <script src="https://kit.fontawesome.com/de5a643238.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="container">
        <form method="post">
            <div class="form-input">
                <label for="first-name">New Password</label>
                <input type="password" name="new-password">
            </div>
            <div class="form-input">
                <label for="last-name">Confirm Password</label>
                <input type="password" name="confirm-password">
            </div>
            <div class="form-input buttons-container">
                <input type="submit" name="submit" value="Update">
            </div>
        </form>
    </div>
</body>

</html>
<style>
    body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: black;
}

#container {
    width: 400px;
    border-radius: 8px;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    z-index: 0;
}
.form-input {
    margin-bottom: 20px;
}

.form-input label {
    display: block;
    color: #000000; 
    font-weight: bold;
}

.form-input input {
    width: 90%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #2CCCC3;
    border-radius: 5px;
}

.buttons-container {
    display: flex;
    justify-content: space-between;
}

.buttons-container input {
    border-radius: 30px;
    color: white;
    background-color: #5626C4;
    flex-basis: 48%;
}

.buttons-container input:hover {
    background-color: #E60576;
    color: white;
    box-shadow: 1px 3px 4px #E60576;
    border-color: #E60576;
}


    /* msg css starts */
    #messageBox {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #f3f3f3;
        color:black;
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