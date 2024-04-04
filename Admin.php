<?php
@include('connection.php');
session_start();
$name = $_SESSION['adminname'];
?>
<?php
if (isset($msg)) {
    foreach ($msg as $msg) {
        echo "
        <div id='messageBox'>
          <span class='closeButton' onclick='this.parentElement.remove()'>&times;</span>
          <p>$msg</p>
        </div>
";
    }
}
?>
<html>

<head>
    <title>Admin Panel</title>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/admin_page.css">
    <link rel="stylesheet" href="css/adminProduct.css">

    <script src="jquery.js"></script>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <h2><span><img onclick="closeNav()" src="images/headphone-64.png" width="50px" alt="logo"></span>Earphone Zone</h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="#" class="active"><span class="lab la-buromobelexperte"></span><span>Dashboard</span></a></li>
                <li><a href="#accounts_spacing1"><span class="las la-user-circle"></span><span>Accounts</span></a></li>
                <li><a href="#msgs_spacing1"><span class="las la-comment-dots"></span><span>Messages</span></a></li>
                <li><a href="#products_spacing1"><span class="lab la-product-hunt"></span><span>Products</span></a></li>
                <li><a href="#orders_spacing"><span class="las la-shopping-bag"></span><span>Orders</span></a></li>
                <li><a href="logout.php"><span class="las la-sign-in-alt"></span><span>Logout</span></a></li>
            </ul>
        </div>
    </div>
    <script>
        let list = document.querySelectorAll(".sidebar-menu li a");
        list.forEach(i => {
            i.addEventListener('click', () => {
                document.querySelector('.active')?.classList.remove('active');
                i.classList.add('active');

            });
        });
    </script>
    <div class="main-content" id="main-content">
        <header>
            <h2>
                <label for="" onclick="openNav()"><span class="las la-bars"></span></label>
                Dashboard
            </h2>
            <div class="user-wrapper">
                <h4><?php echo $name; ?></h4>
                <small>Admin</small>
            </div>
        </header>
        <main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <?php
                        $users = mysqli_query($conn, "SELECT * FROM `users1`") or die('query failed');
                        $total_users = mysqli_num_rows($users);
                        ?>
                        <h1><?php echo $total_users; ?></h1>
                        <span class="card-text">Accounts</span>
                        <div class="icon"><span class="las la-users"></span></div>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <?php
                        $msgs = mysqli_query($conn, "SELECT * FROM `messages`") or die('query failed');
                        $total_msgs = mysqli_num_rows($msgs);
                        ?>
                        <h1><?php echo $total_msgs; ?></h1>
                        <span class="card-text">Messages</span>
                        <div class="icon"><span class="las la-comment-dots"></span></div>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <?php
                        $product = mysqli_query($conn, "SELECT * FROM `product`") or die('failed');
                        $total_product = mysqli_num_rows($product);
                        ?>
                        <h1><?php echo $total_product; ?></h1>
                        <span class="card-text">Products</span>
                        <div class="icon"><span class="lab la-product-hunt"></span></div>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <?php
                        $orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed'); /* to check total orders */
                        $total_orders = mysqli_num_rows($orders);
                        ?>
                        <h1><?php echo $total_orders; ?></h1>
                        <span class="card-text">Orders</span>
                        <div class="icon"><span class="las la-shopping-bag"></span></div>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <?php
                        $income = mysqli_query($conn, "SELECT SUM(total_price) AS total_sum FROM orders") or die('query failed');
                        $row = mysqli_fetch_assoc($income);
                        $totalIncome = $row['total_sum'];
                        ?>
                        <h1><?php echo $totalIncome; ?></h1>
                        <span class="card-text">Income</span>
                        <div class="icon"><span class="las la-money-bill-wave"></span></div>
                    </div>
                </div>
            </div>

            <!-- -----------------------Accounts Info starts here----------------------- -->
            <div class="products_spacing"></div>
            <div id="accounts_spacing1"></div>
            <div id="accounts"><span>Accounts</span></div>
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">User Type</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">password</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $users = mysqli_query($conn, "SELECT * FROM `users1`");
                        /* for calculating total users */
                        while ($row = mysqli_fetch_assoc($users)) {
                            echo "
                                <tr>
                                    <td>$row[id]</td>
                                    <td>$row[user_type]</td>
                                    <td>$row[firstname]</td>
                                    <td>$row[lastname]</td>
                                    <td>$row[email]</td>
                                    <td>$row[password]</td>
                                    <td><a href='delete.php? userId= $row[id]&userEmail=$row[email]' class = 'btn'>Delete</a></td>
                                </tr>
                                ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- -----------------------Accounts Info ends here----------------------- -->

            <!-- -----------------------Messages starts here----------------------- -->
            <div class="products_spacing"></div>
            <div id="msgs_spacing1"></div>
            <div id="msgs"><span>Messages</span></div>
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Messages</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $messages = mysqli_query($conn, "SELECT * FROM `messages`");
                        while ($row = mysqli_fetch_assoc($messages)) {
                            echo "
                                <tr>
                                    <td>$row[msg_id]</td>
                                    <td>$row[name]</td>
                                    <td>$row[email]</td>
                                    <td>$row[messages]</td>
                                    <td><a href='delete.php? userId= $row[user_id]&msgId=$row[msg_id]' class = 'btn'>Delete</a></td>
                                </tr>
                                ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- -----------------------Messages Info ends here----------------------- -->

            <!-- -----------------------Add products----------------------- -->

            <div class="products_spacing"></div>
            <div id="products_spacing1"></div>
            <div id="products"><span>Add Products</span></div>
            <center>
                <section id='product' class="form-container">
                    <form action="admin_product.php" method="post" enctype="multipart/form-data">
                        <p>Name <span>*</span></p>
                        <input type="text" name="product_name" placeholder="Enter Product Name" required maxlength="50" class="box">
                        <p>Category <span>*</span></p>
                        <select name="category" id="category">
                            <option value="earphone">Earphone</option>
                            <option value="neckband">Neckband</option>
                            <option value="earbuds">Earbuds</option>
                        </select>
                        <p>Price <span>*</span></p>
                        <input type="text" name="product_price" placeholder="Enter Prodct price" required maxlength="50" class="box">
                        <p>Product Details <span>*</span></p>
                        <input type="text" name="product_details" placeholder="Enter Product Details" required class="box">
                        <p>Product Image <span>*</span></p>
                        <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="uploaded_img" required>
                        <input type="submit" value="Upload Product" name="upload" class="btn">
                    </form>
                </section>
            </center>


            <!-- fetch data -->

            <div class="container">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Details</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Delete</th>
                            <th scope="col">Update</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $pic = mysqli_query($conn, "SELECT * FROM `product`");
                        while ($row = mysqli_fetch_array($pic)) {
                            echo "
                                <tr>
                                    <td>$row[prod_id]</td>
                                    <td>$row[prod_name]</td>
                                    <td>$row[category]</td>
                                    <td class='details'>$row[prod_details]</td>
                                    <td>$row[prod_price]</td>
                                    <td><img class='prodImg' src='uploaded_img/$row[prod_image]'></td>
                                    <td><a href='delete.php? Id= $row[prod_id]' class = 'btn'>Delete</a></td>
                                    <td><a href='update_product.php? Id= $row[prod_id]' class = 'btn'>Update</a></td>
                                </tr>
                                ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- -----------------------Add products ends here----------------------- -->

            <!-- -----------------------------Orders starts here----------------------------- -->
            <div class="products_spacing"></div>
            <div id="orders_spacing"></div>
            <div id="orders"><span>Manage Orders</span></div>

            <!-- fetch data -->
            <div class="container">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Payment method</th>
                            <th scope="col">Status</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $pic = mysqli_query($conn, "SELECT * FROM `orders`");
                        while ($row = mysqli_fetch_array($pic)) {
                        ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['number'] ?></td>
                                <td><?php echo $row['order_date'] ?></td>
                                <td><?php echo $row['method'] ?></td>
                                <td class="<?php echo ($row['status'] == 'pending') ? 'pending' : 'delivered'; ?>"><?php echo $row['status'] ?></td>
                                <td>
                                    <form action="update_order_status.php" method='post'>
                                        <input type='hidden' name='order_id' value='<?php echo $row['id'] ?>'>
                                        <select class="status" name='order_status' id='order_status'>
                                            <option value='pending' <?php if ($row['status'] == 'pending') ?>>pending</option>
                                            <option value='delivered' <?php if ($row['status'] == 'delivered') ?>>delivered</option>
                                        </select>
                                        <input class="update_btn" type='submit' name='update_status' value='Update'>
                                    </form>
                                </td>
                                <td><a href="delete.php?orderId=<?php echo $row['id'] ?>" class="btn">Delete</a></td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <!-- -----------------------------Orders ends here----------------------------- -->

        </main>
    </div>
</body>

</html>