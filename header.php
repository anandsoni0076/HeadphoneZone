<?php
@include('connection.php');
if(isset($_SESSION['userid'])){
    $user_id = $_SESSION['userid'];
    $rows = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id=$user_id") or die('query failed');
    $row_count = mysqli_num_rows($rows);
}

?>

<head>
    <title>Cool CSS Navbar</title>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/de5a643238.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="jquery.js"></script>
</head>

<header>
    <nav class="navbar">
        <div class="navbar-logo">
            <img src="images/headphone-64.png" alt="Logo">
            <a href="#" class='logotext'>Earphone Zone</a>
        </div>

        <div class="navbar-links">
            <ul>
                <li><a href="welcome.php">Home</a></li>
                <li class="dropdown">
                    <a href="#">Category</a>
                    <div class="dropdown-content">
                        <a href="categories.php?category=earphone">Earphones</a>
                        <a href="categories.php?category=neckband">Neckbands</a>
                        <a href="categories.php?category=earbuds">TWS</a>
                    </div>
                <li><a href="AboutUs.php">About US</a></li>
                
                <?php 
                    if(isset($_SESSION['userid'])){
                        $user_id = $_SESSION['userid'];
                    ?>  
                        <li class="cart-link">
                    <a href="cart.php">
                        <div class="cart-icon-container">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span><?php echo $row_count ?></span>
                        </div>
                    </a>
                </li>

                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href="account.php">Profile</a>
                    <a href="#">Hello <?php echo $_SESSION['userfname']; ?></a>
                    <a href="#"><?php echo $_SESSION['useremail']; ?></a>
                    <a href="logout.php">LogOut</a>
                </div>  
                    <li><a id='main' style='cursor:pointer' onclick='openNav()'><i class='fa-solid fa-user'></i></a></li>
                    <?php }
                    else{
                        echo "<li class='login_btn_bg' ><a href='LoginForm.php'>Login<i class='fa-solid fa-right-to-bracket'></i></a></li>";
                    }
                ?>
                
                <!-- Your existing script tags here -->
                <script>
                    function openNav() {
                        document.getElementById("mySidenav").style.width = "300px";
                        document.getElementById("main").style.marginLeft = "300px";
                    }
                    function closeNav() {
                        document.getElementById("mySidenav").style.width = "0";
                        document.getElementById("main").style.marginLeft = "0";
                    }
                </script>
            </ul>
        </div>
    </nav>

</header>

</html>
<style>
    @import url('css/colorCodes.css');
    header {
        margin: 0;
        padding: 0;
    }

    .logotext {
        text-decoration: none;
        font-size: 2rem;
        font-weight: bolder;
        color: cyan;
        font-family: 'Bruno Ace SC', 'sans-serif';
    }
    .login_btn_bg{
        border: 2px;
    }
    .navbar {
        background-color: #181818;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
    }

    .navbar-logo {
        display: flex;
        align-items: center;
    }

    .navbar-logo img {
        width: 50px;
        height: 50px;
        margin-right: 10px;
    }

    .navbar-links ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
    }

    .navbar-links li {
        font-size: 20px;
        margin-right: 20px;
        display: inline-block;
        position: relative;
    }

    .navbar-links a {
        text-decoration: none;
        color: var(--light-silver-color);
        padding: 5px 10px;
    }

    .navbar-links a:hover {
        color: cyan;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #181818;
        box-shadow: 0px 2px 8px 1px black;
    }

    .dropdown-content a {
        display: block;
        color: var(--light-silver-color);
        padding: 5px 15px;
        text-decoration: none;
        transition: all 0.2s;
    }

    .dropdown-content a:hover {
        transform: translateX(5px);
        color: cyan;
    }

    .dropdown:hover .dropdown-content {
        display: block;
        z-index: 999;

    }

    .cart-icon-container {
        position: relative;
        display: inline-block;
    }

    .cart-icon-container span {
        position: absolute;
        color: black;
        font-size: 0.7rem;
        padding: 2px;
        border-radius: 50%;
        top: 6px;
        right: -1px;
        background-color: var(--light-silver-color);
    }

    /* siderbar css starts */

    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        right: 0;
        background-color: #181818;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: var(--light-silver-color);
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: cyan;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }


    @media screen and (max-height: 450px) {
        .sidenav {
            padding-top: 15px;
        }

        .sidenav a {
            font-size: 18px;
        }
    }

    /* siderbar css ends here */
</style>