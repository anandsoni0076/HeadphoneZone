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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Image Change</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<?php @include('header.php'); ?>
<body>

            

    <div class="main-wrapper">
        <div class="container">
        <?php
        $product_id= $_GET['product_id'];
        $all_product = mysqli_query($conn, "SELECT * FROM `product` WHERE prod_id=$product_id ") or die('query failed');
        if (mysqli_num_rows($all_product) > 0) {
            while ($fetch_product = mysqli_fetch_assoc($all_product)) {
                $name = $fetch_product['prod_name'];
                $pImage = $fetch_product['prod_image'];
                $details = $fetch_product['prod_details'];
                $price = $fetch_product['prod_price'];
                echo "
                <form action='' method='post'>
                <div class='product-div'>
                <div class='product-div-left'>
                    <div class='img-container'>
                        <img src='uploaded_img/$pImage' alt='watch'>
                    </div>
                </div>
                <div class='product-div-right'>
                    <span class='product-name'>$name</span>
                    <span class='product-price'><i class='las la-rupee-sign'></i>$price</span>
                    <p class='product-description'>$details</p>
                    <div class='btn-groups'>
                        <button type='submit' name='cart_btn' class='add-cart-btn'><i class='fas fa-shopping-cart'></i>add to cart</button>
                        <a href='welcome.php' class='buy-now-btn'><i class='fas fa-arrow-circle-left'></i>Back</a>
                    </div>
                    <input type='hidden' name='product_name' value='$name'>
                    <input type='hidden' name='product_price' value='$price'>
                    <input type='hidden' name='product_image' value='$pImage'>
                </div>
            </div>
        </div>
                </form>";
            }
        } else {
            echo '<p class="empty">No Products Available</p>';
        }
        ?>
    </div>
</body>
</html>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap');
    @import url('css/colorCodes.css');
    * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

html, body {
    font-family: 'Roboto', sans-serif;
    background-color: black;
    color: lightgray;
}

img {
    width: 100%;
    display: block;
}

.main-wrapper {
    min-height: 100vh;
    background-color: black;
    display: flex;
    align-items: center;
    justify-content: center;
}

.container {
    max-width: 1200px;
    padding: 0 1rem;
    margin: 0 auto;
}

.product-div {
    margin: 1rem 0;
    padding: 2rem 0;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    background-color: var(--charcoal-color);
    border-radius: 3px;
    column-gap: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.product-div-left {
    padding: 20px;
}

.product-div-right {
    padding: 20px;
}

.img-container img {
    height: 100%;
    width: 100%;
    margin: 0 auto;
    border-radius: 10px;
    object-fit: cover;
}

.product-name {
    font-size: 28px;
    margin-bottom: 8px;
    font-weight: 700;
    letter-spacing: 1px;
    opacity: 0.9;
    color: cyan;
}

.product-price {
    font-size: 24px;
    opacity: 0.9;
    font-weight: 500;
    color: #FF9F00;
    margin-top: 8px;
}

.product-description {
    font-size: 18px;
    line-height: 1.6;
    font-weight: 300;
    opacity: 0.9;
    margin-top: 20px;
}

.btn-groups {
    margin-top: 20px;
}

.btn-groups button, a {
    display: inline-block;
    text-decoration: none;
    font-size: 16px;
    font-family: inherit;
    text-transform: uppercase;
    padding: 15px 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    border-radius: 3px;
}

.btn-groups button .fas, a .fas {
    margin-right: 8px;
}

.add-cart-btn {
    background-color: #FF9F00;
    color: black;
    margin-right: 8px;
}

.add-cart-btn:hover {
    background-color: #000;
    color: #FF9F00;
}

.buy-now-btn {
    background-color: #000;
    color: cyan;
    margin-right: 8px;
}

.buy-now-btn:hover {
    background-color: cyan;
    color: #000;
}

@media screen and (max-width: 992px) {
    .product-div {
        grid-template-columns: 100%;
    }

    .product-div-right {
        text-align: center;
    }

    .product-description {
        max-width: 400px;
        margin: 20px auto;
    }
}

@media screen and (max-width: 400px) {
    .btn-groups button {
        width: 100%;
        margin-bottom: 10px;
    }
}

</style>
