
<html>
<footer>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <div class="container-foot">
        <div class="leftbox">
            <a href="#" class="logo"><img src="images/headphone-64.png" width="25px" alt="">Earphone Zone</a>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                Hic accusamus iste eaque vero obcaecati veritatis nostrum
                pariatur maxime consequuntur ex.</p>
            <ul class="socialMedia">
                <li><a href="#"><i class="lab la-instagram"></i></a></li>
                <li><a href="#"><i class="lab la-facebook"></i></a></li>
                <li><a href="#"><i class="lab la-linkedin-in"></i></a></li>
                <li><a href="#"><i class="lab la-twitter"></i></a></li>
            </ul>
        </div>

        <div class="centre-box">
            <h3 class="title">Quick Links</h3>
            <ul class="quick-menu">
                <?php 
                if(!isset($_SESSION['userid'])){
                    echo "<li><a href='home.php' class='nav-item'>Home</a></li>";
                }
                else{
                    echo "<li><a href='welcome.php' class='nav-item'>Home</a></li>";
                }
                ?>
                
                <li><a href="AboutUs.php" class="nav-item">About</a></li>
                <li><a href="contact-us.php" class="nav-item">Contact Us</a></li>
            </ul>
        </div>

        <div class="right-box">
            <h3 class="title">Contact Us</h3>
            <ul class="info">
                <li><span><i class="bx bxs-phone"></i><a href="#">+91 564 345 2334</a></span></li>
                <li><span><i class="bx bxs-envelope"></i><a href="#home">Earphone Zone</a></span></li>
            </ul>
        </div>
    </div>
</footer>
<style>
@import url('css/colorCodes.css');
/* Footer container */
.container-foot {
    display: flex;
    justify-content: space-between;
    background-color: var(--charcoal-color);
    color: white;
    padding: 30px 0;
}

/* Left box styling */
.leftbox {
    flex: 1;
    padding: 0 30px;
}

.leftbox .logo {
    color: white;
    font-size: 24px;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 20px;
}

.leftbox p {
    font-size: 14px;
    line-height: 1.5;
}

.socialMedia {
    list-style: none;
    padding: 0;
    margin-top: 20px;
}

.socialMedia li {
    display: inline-block;
    margin-right: 15px;
}

.socialMedia a {
    color: white;
    font-size: 20px;
    text-decoration: none;
}

/* Center box styling */
.centre-box {
    flex: 1;
    padding: 0 30px;
}

.title {
    font-size: 20px;
    margin-bottom: 15px;
}

.quick-menu {
    list-style: none;
    padding: 0;
}

.quick-menu li {
    margin-bottom: 10px;
}

.quick-menu a {
    color: white;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
}

.quick-menu a:hover {
    color: cyan;
}

/* Right box styling */
.right-box {
    flex: 1;
    padding: 0 30px;
}

.info {
    list-style: none;
    padding: 0;
}

.info li {
    margin-bottom: 15px;
}

.info span {
    display: inline-block;
    margin-right: 10px;
    font-size: 16px;
}

.info a {
    color: white;
    text-decoration: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container-foot {
        flex-direction: column;
        align-items: center;
    }
    .leftbox, .centre-box, .right-box {
        padding: 20px;
        text-align: center;
    }
}

</style>
</html>