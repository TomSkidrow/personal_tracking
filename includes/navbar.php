<?php $file_name = basename($_SERVER['SCRIPT_FILENAME'],".php"); ?>
<nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-dark bg-alpha">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="assets/images/logo.png" width="35" height="35" class="d-inline-block align-top" alt="">
            AppzStory Studio
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarKey" aria-controls="navbarKey" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarKey">
            <ul class="navbar-nav ml-auto text-center">
                <li class="nav-item <?php echo $file_name == 'index' ? 'active': '' ?>">
                    <a class="nav-link" href="index.php">หน้าแรก <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php echo $file_name == 'about' ? 'active': '' ?>">
                    <a class="nav-link" href="about.php">เกี่ยวกับเรา</a>
                </li>
                <li class="nav-item <?php echo $file_name == 'blog' || $file_name == 'blog-detail' ? 'active': '' ?>">
                    <a class="nav-link" href="blog.php">บทความ</a>
                </li>
                <li class="nav-item <?php echo $file_name == 'contact' ? 'active': '' ?>">
                    <a class="nav-link" href="contact.php">ติดต่อเรา</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php 

// $file_name == 'index' ? 'active': '';

// if($file_name == 'index'){
//     echo 'active';
// } else {
//     echo '';
// }


?>