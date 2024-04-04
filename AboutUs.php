<?php
session_start();
@include('connection.php');
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" />
    <title>About Us | Earphones Co.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: poppins;
        }

        body {
            background-color: black;
            min-height: 100vh;
            color: #E1E2E2;
        }

        #about-section {
            width: 80%;
            display: flex;
            max-width: 1200px;
            padding: 100px 0;
            justify-content: space-between;
            align-items: center;
            margin: 0 auto;
        }


        .about-left img {
            /* Adjust the image size and position */
            width: 100%;
            max-width: 420px;
            height: auto;
            transform: translateY(50px);
        }

        .about-right {
            width: 54%;
        }

        .about-right ul li {
            display: flex;
            /* Display items horizontally */
            align-items: center;
            /* Align in the center */
        }

        .about-right h1 {
            color: cyan;
            font-size: 37px;
            margin-bottom: 5px;
        }

        .about-right p {
            color: #E1E2E2;
            /* Light Silver */
            line-height: 26px;
            font-size: 15px;
        }

        .about-right .address {
            margin: 25px 0;
        }


        .address .address-logo {
            margin-right: 15px;
            color: cyan;
        }

        .address .saprater {
            margin: 0 11px;
        }

        /* Expertise section */
        .about-right .exp ul {
            display: flex;
            /* Horizontal layout */
            width: 80%;
            /* Set width to 80% of the container */
            align-items: center;
            /* Center items vertically */
            justify-content: space-between;
            /* Space items evenly */
        }

        .exp h3 {
            margin-bottom: 10px;
        }

        .exp .exp-logo {
            font-size: 19px;
            margin-right: 10px;
            color: cyan;
        }
    </style>
</head>

<body>
    <section id="about-section">
        <!-- About left  -->
        <div class="about-left">
            <img src="images/contact_bg1.png" alt="About EarphoneZone" />
        </div>

        <!-- About right  -->
        <div class="about-right">
            <h4>Our Journey</h4>
            <h1>About EarphoneZone</h1>
            <p>EarphoneZone is committed to providing an unbeatable experience for all music lovers.
                We seamlessly integrate cutting-edge technology with elegant design to offer earphones that deliver
                unmatched sound quality and comfort.</p>
            <div class="address">
                <ul>
                    <li>
                        <span class="address-logo">
                            <i class="fas fa-paper-plane"></i>
                        </span>
                        <p>Address</p>
                        <span class="saprater">:</span>
                        <p>123 Sound Street, Cityville, EarphoneLand</p>
                    </li>
                    <li>
                        <span class="address-logo">
                            <i class="fas fa-phone-alt"></i>
                        </span>
                        <p>Contact</p>
                        <span class="saprater">:</span>
                        <p>+1 123-456-7890</p>
                    </li>
                    <li>
                        <span class="address-logo">
                            <i class="far fa-envelope"></i>
                        </span>
                        <p>Email</p>
                        <span class="saprater">:</span>
                        <p>info@earphonesco.com</p>
                    </li>
                </ul>
            </div>
            <div class="exp">
                <h3>Our Experties</h3>
                <ul>
                    <li>
                        <span class="exp-logo">
                            <i class="fas fa-headphones"></i>
                        </span>
                        <p>Audio Quality</p>
                    </li>
                    <li>
                        <span class="exp-logo">
                            <i class="fas fa-microphone"></i>
                        </span>
                        <p>Clear Communication</p>
                    </li>
                    <li>
                        <span class="exp-logo">
                            <i class="fas fa-battery-full"></i>
                        </span>
                        <p>Long Battery Life</p>
                    </li>
                    <li>
                        <span class="exp-logo">
                            <i class="fas fa-tachometer-alt"></i>
                        </span>
                        <p>Sleek Design</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <footer>
        <?php @include('footer.php');
        ?>
    </footer>
</body>

</html>