<?php
@include 'connection.php';
session_start();
$prod_Id = $_GET['Id'];

if (isset($_POST['update'])) {
    $Product_Name = $_POST['product_name'];
    $Product_Price = $_POST['product_price'];
    $Product_Details = $_POST['product_details'];
    $Category = $_POST['category'];

    if ($_FILES['uploaded_img']['error'] === 0) {
        // New image is uploaded
        $img_extension = pathinfo($_FILES['uploaded_img']['name'], PATHINFO_EXTENSION);
        $img_name = uniqid('prod_image') . '.' . $img_extension;
        $img_directory = 'uploaded_img/';
        $img_path = $img_directory . $img_name;

        if (move_uploaded_file($_FILES['uploaded_img']['tmp_name'], $img_path)) {
            mysqli_query($conn, "UPDATE product SET prod_image='$img_name' WHERE prod_id=$prod_Id") or die(mysqli_error($conn));
        } else {
            $display_msg[] = "Error uploading image.";
        }
    }

    // Update other fields
    if (!empty($Product_Name)) {
        mysqli_query($conn, "UPDATE product SET prod_name='$Product_Name' WHERE prod_id=$prod_Id") or die(mysqli_error($conn));
    }
    if (!empty($Product_Price)) {
        mysqli_query($conn, "UPDATE product SET prod_price='$Product_Price' WHERE prod_id=$prod_Id") or die(mysqli_error($conn));
    }
    if (!empty($Product_Details)) {
        mysqli_query($conn, "UPDATE product SET prod_details='$Product_Details' WHERE prod_id=$prod_Id") or die(mysqli_error($conn));
    }
    if (!empty($Category)) {
        mysqli_query($conn, "UPDATE product SET category='$Category' WHERE prod_id=$prod_Id") or die(mysqli_error($conn));
    }

    $display_msg[] = "Updated successfully!";
    header('location: Admin.php#products_spacing1');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/de5a643238.js" crossorigin="anonymous"></script>

    <script src="jquery.js"></script>
</head>
<?php
if (isset($display_msg)) {
    foreach ($display_msg as $display_msg) {
        echo '
  <div class = "display_msg">
     <span>' . $display_msg . '</span>
     <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
  </div>
  ';
    }
}
?>

<body>

<section class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Update Product</h3>
            <p>Name</p>
            <input type="text" name="product_name" placeholder="Enter Product Name" maxlength="50" class="box">
            <p>Category</p>
            <select name="category" id="category">
                <option value="earphone">Earphone</option>
                <option value="neckband">Neckband</option>
                <option value="earbuds">Earbuds</option>
            </select>
            <p>Price</p>
            <input type="text" name="product_price" placeholder="Enter Prodct price" maxlength="50" class="box">
            <p>Product Details</p>
            <input type="text" name="product_details" placeholder="Enter Product Details" class="box">
            <p>Product Image</p>
            <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="uploaded_img">
            <input type="submit" value="Update Product" name="update" class="btn">
        </form>
</section>


</body>
</html>
<style>
  body {
    background-color: #111; /* Dark background */
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  .form-container {
    padding: 20px;
    border: 2px solid #333;
    width: 100%;
    max-width: 400px;
    background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent dark background */
    color: cyan; /* Cyan text color */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  }

  .form-container input {
    width: 94%;
  }

  .box, #category {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 2px solid cyan;
    border-radius: 5px;
    outline: none;
    background-color: transparent; /* Transparent input background */
    color: cyan; /* Cyan text color */
  }

  .btn {
    background-color: cyan;
    color: black;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out; /* Animation for button color */
    width: 50%; /* Button width set to 50% */
    display: block;
    margin: 0 auto; /* Center the button horizontally */
  }

  .btn:hover {
    background-color: #33aacc;
  }


</style>
