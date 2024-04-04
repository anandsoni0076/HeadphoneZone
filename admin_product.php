<?php
@include 'connection.php';
if (isset($_POST['upload'])) {
    $Product_Name = $_POST['product_name'];
    $Category = $_POST['category'];
    $Product_Price = $_POST['product_price'];
    $Product_Details = $_POST['product_details'];
    $Product_Image = $_FILES['uploaded_img'];

    if (!empty($Product_Name) && !empty($Product_Price) && !empty($Product_Details) && !empty($Product_Image)) {
        $img_extension = pathinfo($Product_Image['name'], PATHINFO_EXTENSION);

        $img_name = uniqid('prod_image') . '.' . $img_extension;

        $img_directory = 'uploaded_img/';

        $img_path = $img_directory . $img_name;

        if (move_uploaded_file($Product_Image['tmp_name'], $img_path)) {

            mysqli_query($conn, "INSERT INTO `product` (`prod_name`,`category`, `prod_details`, `prod_price`, `prod_image`) VALUES ('$Product_Name','$Category', '$Product_Details', '$Product_Price', '$img_name')") or die('Query failed');

            $display_msg[] = "Uploaded successfully!";
            header('location: Admin.php#products_spacing1');
        } else {
            $display_msg[] = "Error uploading files.";
        }
    } else {
        $display_msg[] = "Please fill all required fields.";
    }
}
?>