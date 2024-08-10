<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="/resources/bootstrap/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/resources/css/misc.css">
    <link rel="stylesheet" type="text/css" href="/resources/css/blue-scheme.css">
    <!-- JavaScripts -->
    <script src="/resources/js/jquery-1.10.2.min.js"></script>
    <script src="/resources/js/jquery-migrate-1.2.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>


    <style>
        .app-container {
            height: 100vh;
            width: 100%;
        }
        .complete {
            text-decoration: line-through;
        }
    </style>
    <title>To Do App</title>
    <link rel="shortcut icon" href="/resources/images/favicon.ico" type="image/x-icon" />
</head>
<body>

<div class="responsive_menu">
    <ul class="main_menu">
        <li><a href="index.html">Home</a></li>
        <li><a href="#">Portfolio</a>
            <ul>
                <li><a href="portfolio.html">Portfolio Grid</a></li>
                <li><a href="project-image.html">Project Image</a></li>
                <li><a href="project-slideshow.html">Project Slideshow</a></li>
            </ul>
        </li>
        <li><a href="#">Blog</a>
            <ul>
                <li><a href="blog.html">Blog Standard</a></li>
                <li><a href="blog-single.html">Blog Single</a></li>
                <li><a href="#">visit templatemo</a></li>
            </ul>
        </li>
        <li><a href="archives.html">Archives</a></li>
    </ul> <!-- /.main_menu -->
</div>
<header class="site-header clearfix">
    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="pull-left logo">
                    <a href="index.html">
                        <img src="/resources/images/logo.png" alt="Medigo">
                    </a>
                </div>	<!-- /.logo -->

                <div class="main-navigation pull-right">

                    <nav class="main-nav visible-md visible-lg">
                        <ul class="sf-menu">
                            <li><a href="/tasks/index">tasks</a></li>
                            <?php
                            if (isset($_SESSION['user'])){
                            ?>
                            <li><a href="/logout">logout</a></li>
                            <?php } else{?>
                            <li><a href="/login">login</a>
                                <ul>
                                    <li><a href="portfolio.html">Portfolio Grid</a></li>
                                    <li><a href="project-image.html">Project Image</a></li>
                                    <li><a href="project-slideshow.html">Project Slideshow</a></li>
                                </ul>
                            </li>
                            <li><a href="/register">sign up</a></li>
                            <?php } ?>
                        </ul> <!-- /.sf-menu -->
                    </nav> <!-- /.main-nav -->

                    <!-- This one in here is responsive menu for tablet and mobiles -->
                    <div class="responsive-navigation visible-sm visible-xs">
                        <a href="#nogo" class="menu-toggle-btn">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div> <!-- /responsive_navigation -->

                </div> <!-- /.main-navigation -->

            </div> <!-- /.col-md-12 -->

        </div> <!-- /.row -->

    </div> <!-- /.container -->
</header> <!-- /.site-header -->
        <div class="col-md-12 blog-posts">
                        {{content}}
        </div>
    <div>
        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="footer-nav clearfix">
                            <ul class="footer-menu">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="portfolio.html">Portfolio</a></li>
                                <li><a href="blog.html">Blog Posts</a></li>
                                <li><a href="archives.html">Shortcodes</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul> <!-- /.footer-menu -->
                        </nav> <!-- /.footer-nav -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <p class="copyright-text">Copyright &copy; 2084 Company Name</p>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </footer> <!-- /.site-footer -->
    </div>


</body>
</html>
