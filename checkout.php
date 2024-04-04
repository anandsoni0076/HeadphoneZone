<?php

@include 'connection.php';
session_start();
$user_id = $_SESSION['userid'];

// for clearing cart 
function clearCart($conn, $user_id) {
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = $user_id");
}


if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $state = $_POST['state'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id=$user_id");
   $price_total = 0;
   //
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['prod_name'] .' ('. $product_item['quantity'] .') ';
         $product_price = $product_item['prod_price'] * $product_item['quantity'];
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `orders`(user_id,name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price) VALUES('$user_id','$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_product','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
         <div class='order-message-container'>
         <div class='message-container'>
            <h3>thank you for shopping!</h3>
            <div class='order-detail'>
               <span>".$total_product."</span>
               <span class='total'> total : $".$price_total."/-  </span>
            </div>
            <div class='customer-details'>
               <p> your name : <span>".$name."</span> </p>
               <p> your number : <span>".$number."</span> </p>
               <p> your email : <span>".$email."</span> </p>
               <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
               <p> your payment mode : <span>".$method."</span> </p>
               <p>(*pay when product arrives*)</p>
            </div>
               <a href='welcome.php' onclick='clearCart()' class='btn'>continue shopping</a>
            </div>
         </div>
      ";
      clearCart( $conn,$user_id);
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>checkout</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="stylesheet" href="css/checkout.css">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


</head>
<body>
<?php @include('header.php');?>
<div class="checkout_container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id=$user_id");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = $fetch_cart['prod_price'] * $fetch_cart['quantity'];
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['prod_name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>
   </div>

      <div class="flex">
         <div class="user-input">
            <span>your name</span>
            <input type="text" placeholder="Enter your name" name="name" value="<?php echo $_SESSION['userfname']." ".$_SESSION['userlname'];?>" required>
         </div>
         <div class="user-input">
            <span>your number</span>
            <input type="number" placeholder="enter your number" name="number" maxlength="10" value="<?php echo $_SESSION['userMobile'];?>" required>
         </div>
         <div class="user-input">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" value="<?php echo $_SESSION['useremail'];?>" required>
         </div>
         <div class="user-input">
            <span>payment method</span>
            <select name="method">
               <option value="cash on delivery" selected>cash on devlivery</option>
               <option value="credit cart">credit cart</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="user-input">
            <span>Address</span>
            <input type="text" placeholder="Enter your Address" name="flat" required>
         </div>
         <div class="user-input">
            <span>LandMark</span>
            <input type="text" placeholder="e.g. street name" name="street" required>
         </div>
         <div class="user-input">
            <span>city</span>
            <input type="text" placeholder="e.g. mumbai" name="city" required>
         </div>
         <div class="user-input">
            <span>state</span>
            <input type="text" placeholder="e.g. maharashtra" name="state" required>
         </div>
         <div class="user-input">
            <span>country</span>
            <input type="text" placeholder="e.g. india" name="country" required>
         </div>
         <div class="user-input">
            <span>pin code</span>
            <input type="text" placeholder="e.g. 123456" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>