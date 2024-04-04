<?php
session_start();
@include('connection.php');
if (isset($_POST['cart_btn'])) {
    if (!isset($_SESSION['userid'])) {
        header('location: loginForm.php');
    }
    else{
        $user_id = $_SESSION['userid'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = 1;

        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id=$user_id && prod_name = '$product_name'");

        if (mysqli_num_rows($select_cart) > 0) {
            $message[] = 'product already added to cart';
        } else {
            $insert_product = mysqli_query($conn, "INSERT INTO `cart`(user_id,prod_name, prod_price, prod_image, quantity) VALUES($user_id,'$product_name', '$product_price', '$product_image', '$product_quantity')");
            $message[] = 'product added to cart succesfully';
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>HomePage</title>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/de5a643238.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="jquery.js"></script>
</head>
<?php
@include('header.php');
if (isset($message)) {
    if (is_array($message)) {
        foreach ($message as $msg) {
            echo "
                <div id='messageBox'>
          <span class='closeButton' onclick='this.parentElement.remove()'>&times;</span>
          <p>$msg</p>
        </div>";
        }
    }
}

?>

<body>
    <div class="container">
        <?php
        $all_product = mysqli_query($conn, "SELECT * FROM `product`") or die('query failed');
        if (mysqli_num_rows($all_product) > 0) {
            while ($fetch_product = mysqli_fetch_assoc($all_product)) {
                $name = $fetch_product['prod_name'];
                $pImage = $fetch_product['prod_image'];
                $details = $fetch_product['prod_details'];
                $price = $fetch_product['prod_price'];
                echo "
                <form action='' method='post'>
                <div class='product'>
                <img src='uploaded_img/$pImage' alt='Product 1'>
                <div class='product-name'>$name</div>
                <div class='product-details'>$details</div>
                <div class='product-price'><i class='las la-rupee-sign'></i>$price/-</div>
                <input type='hidden' name='product_name' value='$name'>
            <input type='hidden' name='product_price' value='$price'>
            <input type='hidden' name='product_image' value='$pImage'>
            <input type='hidden' name='product_details' value='$details'>
                <button type='submit' name='cart_btn' class='buy-button'>Add to cart</button>
                <a href='product_detail.php?product_id= $fetch_product[prod_id]' class='buy-button'>View</a>
            </div>
                </form>";
            }
        } else {
            echo '<p class="empty">No Products Available</p>';
        }
        ?>
    </div>

</body>

<footer>
    <?php
    @include('footer.php');
    ?>
</footer>

</html>
<style>
    @import url('css/colorCodes.css');

    body {
        font-family: Arial, sans-serif;
        background-color: black;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        margin: 20px;
        padding-bottom: 100px;
    }

    .product {
        border: 1px solid cyan;
        border-radius: 10px;
        padding: 20px;
        margin: 10px;
        width: 250px;
        background-color: var(--charcoal-color);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .product img {
        width: 250px;
        height: 250px;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .product-details {
        color: var(--light-silver-color);
    }

    .product-name {
        font-size: 18px;
        font-weight: bold;
        color: cyan;
    }

    .product-price {
        font-size: 16px;
        color: #555;
    }

    .buy-button {
        display: inline-block;
        padding: 8px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .buy-button:hover {
        background-color: #0056b3;
    }
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