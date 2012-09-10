<?php

header("Content-Type: text/html; charset=utf-8");
const FNAME = "fullname";
const EMAIL = "email";
const WEBSITE = "website";
const MSG = "msg";


if($_GET['q']) {
    $fname = $_GET[FNAME];
    $email = $_GET[EMAIL];
    $website = $_GET[WEBSITE];
    $msg = $_GET[MSG];

    if (!isset($fname)) {
        $fname_error = true;
        $any_error =true;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = true;
        $any_error =true;
    }
    if (!filter_var($website, FILTER_VALIDATE_URL)) {
        $website_error = true;
        $any_error =true;
    }
    if (!isset($msg)) {
        $msg_error = true;
        $any_error =true;
    }
    echo '1:'.$fname_error;
    echo '2:'.$email_error;
    echo $website.':'.$website_error;
    echo '4:'.$msg_error;

    if (!$any_error) {
        include_once("data/dblayer.php");
        try {
            DBConnection::saveMessageToDB($fname, $email, $website, $msg);
        } catch (Exception $e) {
            error_log($e);
            echo "Error while saving result to db. ".$e->getMessage();
        }
    }
}
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="js/vendor/modernizr-2.6.1.min.js"></script>
    <!-- live reload snippet-->
    <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</head>
<body>
<div class="header-container">
    <header class="wrapper clearfix">
        <h1 class="title ir" title="Company name">Company name</h1>
        <nav class="main-navigation">
            <ul role="navigation">
                <li class="nav"><a href="#" class="nav">Home<br />Service Description</a></li>
                <li class="nav"><a href="#" class="nav">Our aim<br />Service Description</a></li>
                <li class="nav"><a href="#" class="nav">About us<br />Service Description</a></li>
                <li class="nav"><a href="#" class="nav">Contact<br />Service Description</a></li>
            </ul>
        </nav>
    </header>
</div>
<div class="main-container" role="main">
    <div class="wrapper clearfix">
        <section class="banner-container clearfix">
            <article class="banner">
                    <img src="img/banner1.jpg" alt="some info">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ante enim, tempor quis, consectetur in, sollicitudin a, nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
            </article>
            <article class="banner">
                <img src="img/banner1.jpg" alt="some info">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec.</p>
            </article>
        </section>
        <section class="content-container clearfix">
                <div class="content">
                    <h1>
                        Welcome To Our Site
                    </h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut mauris tIn a orci non turpis elemInteger ornare nisl in tortor. Curabitur accumsan erat ut lorem. Sed iaculis commodo erat. Curaest dui, lacinia vitae, adipiscing vitae, feugiat sit amet, tortor
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut mauris tIn a orci non turpis elemInteger ornare nisl in tortor. Curabitur accumsan erat ut lorem. Sed iaculis commodo erat. Curaest dui, lacinia vitae, adipiscing vitae, feugiat sit amet, tortor
                    </p>
               </div>
        </section>
    </div>
        <section class="company-info clearfix">
        <div class="wrapper">

            <article >
                    <a><h2 class="icon-home">Lorme Ipsom Dolor</h2></a>
                    <p>Lorem Ipsum is simply dummy text of the
                        printing and typesetting industry. Lorem Ip unknown printer took a galley of type and</p>
                    <a>see more..</a>
            </article>
            <article  >
                <a><h2 class="icon-paper">Lorme Ipsom Dolor</h2></a>
                    <p>Lorem Ipsum is simply dummy text of the
                        printing and typesetting industry. Lorem Ip unknown printer took a galley of type and</p>
                    <a>see more..</a>
            </article>

            <article class="last">
                <a><h2 class="icon-bag">Lorme Ipsom Dolor</h2></a>
                    <p>Lorem Ipsum is simply dummy text of the
                        printing and typesetting industry. Lorem Ip unknown printer took a galley of type and</p>
                    <a>see more..</a>
            </article>
        </div>
    </section>
    <section class="quick-contact wrapper clearfix">
        <form action="index.php" role="search" method="get" name="quickcontact">
            <input type="hidden" name="q" value="save">
            <fieldset>
                <legend>Quick contact</legend>
                <label for="fullname" class="visuallyhidden">Name</label>
                <input id="fullname" type="text" name="<?=FNAME?>" placeholder="Name" title="Name" required="required" />
                <label for="email" class="visuallyhidden">e-mail</label>
                <input id="email" type="email" name="<?=EMAIL?>" placeholder="e-mail" title="e-mail" required="required" />
                <label for="website" class="visuallyhidden" >Website <abbr title="Uniform resource locator">URL</abbr></label>
                <input id="website" name="<?=WEBSITE?>" type="url" placeholder="Website URL" title="Website URL" required="required" />
                <label for="msg" class="visuallyhidden">Write your message here</label>
                <textarea id="msg" name="<?=MSG?>" required="required" placeholder="Write your message here" title="Write your message here."></textarea>
                <input type="submit" title="Submit">
            </fieldset>
        </form>
    </section>
</div> <!-- #main-container -->
<div class="footer-container">
    <footer class="wrapper">
        &copy;<span class="rss">RSS</span>
    </footer>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.1.min.js"><\/script>')</script>

<script src="js/main.js"></script>
</body>
</html>
