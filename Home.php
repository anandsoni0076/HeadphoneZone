<html>
<head>
    <title>HomePage</title>
    <script src="https://kit.fontawesome.com/de5a643238.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <script src="jquery.js"></script>
    <link href="style.css" rel="stylesheet">
</head>
<header>
    <?php 
    @include('header.php');
    ?>
</header>
<style>
    header {
    margin: 0;
    padding: 0;
}
body{
    background-color: black;
    color: #FACD3D; 
}
/* css for .desc class */
.heading1{
    color: #FACD3D;
}
</style>
</header>

<body>
    <div class="slider"></div>
        <center><video class="vid" autoplay loop muted src="videos\vid.mp4"></video></center>
        <div class="vidBox">
            <div class="box">
                <div class="desc">
                    <p class="heading">The True Beauty of music is that it connects people</p>
                    <p><b>And we believe a Headphone or Earphone is more than just an instrument for sound. It is the key to
                            a path of emotion, bringing you closer to your favourite artist, and
                            yourself.</b></p>
                </div>
            </div>
        </div>
        <p class="heading1">Start your music journey here</p>
        <center><video class="ads" muted autoplay loop src="videos\ads.mp4"></video></center>
        <div class="number"></div>
        <p class="heading2">Music Lovers with Us</p>
</body>
<footer>
    <?php 
    @include("footer.php");
    ?>
</footer>

</html>