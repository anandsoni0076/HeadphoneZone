<?php
@include('connection.php');
@include('account.php');

if (isset($_POST['submit'])){
    $firstname = $_POST['first-name'];
    $lastname = $_POST['last-name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    if (!empty($firstname)) {
        mysqli_query($conn, "UPDATE `users1` SET firstname = '$firstname' WHERE id = '$user_id'") or die(mysqli_error($conn));
    }
    if (!empty($lastname)) {
        mysqli_query($conn, "UPDATE `users1` SET lastname = '$lastname' WHERE id = '$user_id'") or die(mysqli_error($conn));
    }
    if (!empty($email)) {
        mysqli_query($conn, "UPDATE `users1` SET email = '$email' WHERE id = '$user_id'") or die(mysqli_error($conn));
    }
    if (!empty($mobile)) {
        mysqli_query($conn, "UPDATE `users1` SET mobileNo = '$mobile' WHERE id = '$user_id'") or die(mysqli_error($conn));
    }

    // Fetch the updated user information from the database and update session variables
    $result = mysqli_query($conn, "SELECT * FROM `users1` WHERE id = '$user_id'");
    $row = mysqli_fetch_assoc($result);
    $_SESSION['userfname'] = $row['firstname'];
    $_SESSION['userlname'] = $row['lastname'];
    $_SESSION['userMobile'] = $row['mobileNo'];
    $_SESSION['useremail'] = $row['email'];
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>User Profile Form</title>
	
</head>

<body>
	<div id="container">
		<form method="post">
			<div class="form-group">
				<label for="first-name">First Name</label>
				<input type="text" name="first-name" value="<?php echo $_SESSION['userfname'] ?>">
			</div>
			<div class="form-group">
				<label for="last-name">Last Name</label>
				<input type="text" name="last-name" value="<?php echo $_SESSION['userlname'] ?>">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" value="<?php echo $_SESSION['useremail'] ?>">
			</div>
			<div class="form-group">
				<label for="mobile">Mobile No.</label>
				<input type="tel" name="mobile" value="<?php echo $_SESSION['userMobile'] ?>">
			</div>
			<div class="form-group buttons-container">
			<input type="submit" name="submit" value="Submit">
				<input type="button" value="Cancel" onclick="window.location.href='profile.php';">
			</div>
		</form>
	</div>
	<div id="info">
		<p>First Name:<span><?php echo $_SESSION['userfname'] ?></span></p>
		<p>Last Name:<span><?php echo $_SESSION['userlname'] ?></span></p>
		<p>Mobile Number:<span><?php echo $_SESSION['userMobile'] ?></span></p>
		<p>Email:<span><?php echo $_SESSION['useremail'] ?></span></p>
		<button id="hide1" type="button">Edit</button>
	</div>

	<script>
		const formContainer = document.getElementById("container");
		const hideButton = document.getElementById("hide1");
		const info = document.getElementById("info");
		hideButton.addEventListener("click", function() {
				info.style.display = "none" 
				formContainer.style.display = "block";		
		});
	</script>

</body>
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
			display: none;
		}

		.form-group {
			margin-bottom: 20px;
		}

		.form-group label {
			display: block;
			color: #000000;
			font-weight: bold;
		}

		.form-group input {
			width: 90%;
			padding: 10px;
			font-size: 16px;
			border: 1px solid #2CCCC3;;
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
			/* Set a width for the buttons (you can adjust this value as needed) */
		}

		.buttons-container input:hover {
			background-color: #E60576; /* Magenta */
    		box-shadow: 1px 3px 4px #E60576; /* Magenta */
    		border-color: #E60576; /* Magenta */
			color: white;
		}

		/* user info css */
		#info {
			padding: 20px;
			background-color: white;
			color: #000000;
			box-shadow: 1px 4px 6px 1px black;
			border-radius: 10px;
			align-items: center;
			flex-wrap: wrap;
		}

		#info p {
			margin: 10px 10px 20px 0;
			font-size: 16px;
		}

		#info span {
			font-weight: bold;
		}

		#hide1 {
			padding: 10px 20px;
			background-color: #000000;
			color: #ffffff;
			border: none;
			cursor: pointer;
			border-radius: 5px;
			transition: background-color 0.3s ease;
			margin-top: 10px;
			display: block;
			margin: 0 auto;
		}

		#hide1:hover {
			background-color: #333333;
		}

		/* user info css ends */
	</style>

</html>