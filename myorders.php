<?php
@include('connection.php');
@include('account.php');
$user_id=$_SESSION['userid'];
?>
<div id="orders"><span>My Orders</span></div>
<style>@import url('css/adminProduct.css');</style>
<!-- fetch data -->
<div class="order-container">
    <?php
    $pic = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id=$user_id");
    while ($row = mysqli_fetch_array($pic)) {
    ?>
        <div class="order-box">
            <div class="order-header">
                <h4>Order ID: <?php echo $row['id'] ?></h4>
                <p>Order Date: <?php echo $row['order_date'] ?></p>
            </div>
            <div class="order-details">
                <p><strong>Customer:</strong> <?php echo $row['name'] ?></p>
                <p><strong>Customer:</strong> <?php echo $row['total_products'] ?></p>
                <p><strong>Contact:</strong> <?php echo $row['number'] ?></p>
                <p><strong>Payment Method:</strong> <?php echo $row['method'] ?></p>
                <p><strong>Status:</strong> <span class="<?php echo ($row['status'] == 'pending') ? 'pending' : 'delivered'; ?>"><?php echo $row['status'] ?></span></p>
            </div>
            <div class="delete-btn">
                <a href="delete.php?orderId=<?php echo $row['id'] ?>" class="btn">Delete</a>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<style>
    @import url('css/colorCodes.css');
.order-container {
    display: grid;
    padding-top: 100px;/* padding for top */
    grid-gap: 20px;/*grid gap*/
    grid-template-columns: repeat(3, minmax(300px, 1fr));/* grid layout with 3 columns */
}

.order-box {
    background-color: var(--charcoal-color);
    border: 1px solid var(--light-silver-color);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.order-header {
    display: flex;
    margin-bottom: 10px;
    justify-content: space-between; /* Space between items horizontally */
    align-items: center;/* Align items in the center*/
}

.order-details p {
    margin: 5px 0;
}

.pending {
    color: orange;
}

.delivered {
    color: green;
}

.delete-btn {
    margin-top: 10px;
}
</style>