<?php $file_name = basename($_SERVER['SCRIPT_FILENAME'],".php"); ?>
<section class="position-relative py-5 jarallax" data-speed="0.5" style="background-image: url(https://images.unsplash.com/photo-1519397154350-533cea5b8bff?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=009599aa0979619a04f21ec0d5486955&auto=format&fit=crop&w=1350&q=80);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center ">
                <img src="assets/images/logo.png" class="img-fluid" width="150" alt="">
                <h2 class="text-white display-4 font-weight-bold">AppzStory Studio สอนเขียนเว็บไซต์</h2>
                <div class="star-rating">
                    <span>☆</span>
                    <span>☆</span>
                    <span>☆</span>
                    <span>☆</span>
                    <span>☆</span>
                    <div class="star-current" style="width: 100%;">
                        <span>★</span>
                        <span>★</span>
                        <span>★</span>
                        <span>★</span>
                        <span>★</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="semi-footer p-5 text-center text-md-left">
    <div class="row">
        <div class="col-md-4">
            <a class="navbar-brand" href="#">
                <img src="assets/images/logo.png" width="35" height="35" class="d-inline-block align-top" alt="">
                AppzStory Studio
            </a>
            <p>
                <i class="fa fa-phone-square"></i> 09-999-9999 <br>
                <i class="fa fa-envelope"></i> email@example.com <br>
                <i class="fa fa-address-card"></i> Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, aspernatur!
            </p>
            <a href="https://www.facebook.com/WebAppzStory" target="_blank">
                <i class="fa fa-facebook-square fa-2x"></i>
            </a>
            <a href="https://www.youtube.com/appzstorystudio" target="_blank">
                <i class="fa fa-youtube-square fa-2x"></i>
            </a>
        </div>
        <div class="col-md-3">
            <h4>เมนู</h4>
            <ul class="navbar-nav">
                <li class="nav-item <?php echo $file_name == 'index' ? 'active': '' ?>">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php echo $file_name == 'about' ? 'active': '' ?>">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item <?php echo $file_name == 'blog' || $file_name == 'blog-detail' ? 'active': '' ?>">
                    <a class="nav-link" href="blog.php">Blog</a>
                </li>
                <li class="nav-item <?php echo $file_name == 'contact' ? 'active': '' ?>">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
        <div class="col-md-5">
            <h4>แผนที่</h4>
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=%E0%B8%81%E0%B8%A3%E0%B8%B8%E0%B8%87%E0%B9%80%E0%B8%97%E0%B8%9E&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
                <style>
                .mapouter{text-align:right;height:300px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:300px;width:100%;}
                </style>
            </div>
        </div>
    </div>
</footer>
<footer class="footer">
    <span> COPYRIGHT © 2018 
        <a href="https://www.facebook.com/WebAppzStory" target="_blank">AppzStory Studio</a>
        ALL Right Reserved
    </span>
</footer>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAN7pVYXyLuKkftPkDMFhpTjov4MYVxTnY&callback=initMap"></script>
