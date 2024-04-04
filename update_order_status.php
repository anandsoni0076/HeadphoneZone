<?php 
@include('connection.php');
    if (isset($_POST['update_status'])) {
        $orderStatus = $_POST['order_status'];
        $orderId = $_POST['order_id'];
                        
                            
        $updateQuery = "UPDATE orders SET status = '$orderStatus' WHERE id = $orderId";
        $result = mysqli_query($conn, $updateQuery);
                        
        if ($result) {
             header('location: Admin.php#orders_spacing');
        }
        else {
            echo "Error updating order status: " . mysqli_error($conn);
        }
    }
?>
