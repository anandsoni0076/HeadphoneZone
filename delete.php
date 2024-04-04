<?php 
@include('connection.php');
session_start();
$user_id = $_GET['userId'];

// 

// DELETE messages
if (isset($user_id) && isset($_GET['msgId'])) {
    
    $msg_id = $_GET['msgId'];
    mysqli_query($conn, "DELETE FROM messages WHERE user_id = '$user_id' AND msg_id = '$msg_id'") or die('Query failed');
    header('location: Admin.php#msgs_spacing1');
}


// DELETE user 
    
if (isset($user_id) && isset($_GET['userEmail'])) {
    $user_email = $_GET['userEmail'];
    mysqli_query($conn, "DELETE FROM users1 WHERE id = '$user_id' AND email='$user_email'") or die('Query failed');
    header('location: Admin.php#accounts_spacing1');
}

//DELETE Product 
if (isset($_GET['Id'])) {
    $prod_Id = $_GET['Id'];
    mysqli_query($conn, "DELETE FROM product WHERE prod_id = '$prod_Id'") or die('Query failed');

    header('location: Admin.php#products_spacing1');
}

//DELETE orders
if (isset($_GET['orderId'])) {
    $order_Id = $_GET['orderId'];
    mysqli_query($conn, "DELETE FROM orders WHERE id = '$order_Id'") or die('Query failed');

    header('location: Admin.php#orders_spacing');
}
?>
