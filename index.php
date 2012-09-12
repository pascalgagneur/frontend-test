<?php

header("Content-Type: text/html; charset=utf-8");
const FNAME = "fullname";
const EMAIL = "email";
const WEBSITE = "website";
const MSG = "msg";

$fname;
$email = "";
$website = "";
$msg;

$any_error = false;
$fname_error = false;
$email_error = false;
$website_error = false;
$msg_error = false;

$messageSent = false;

$user_msg = "";

if($_GET['q']) {
    $fname = $_GET[FNAME];
    $email = $_GET[EMAIL];
    $website = $_GET[WEBSITE];
    $msg = $_GET[MSG];

    if (strlen(trim($fname)) <= 0 ) {
        $fname_error = true;
        $any_error = true;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = true;
        $any_error =true;
    }
    if (!filter_var($website, FILTER_VALIDATE_URL)) {
        $website_error = true;
        $any_error =true;
    }
    if (strlen(trim($msg)) <= 0 ) {
        $msg_error = true;
        $any_error =true;
    }

    if (!$any_error) {
        include_once("data/dblayer.php");
        try {
            DBConnection::saveMessageToDB($fname, $email, $website, $msg);
            $messageSent = true;
            $fname = "";
            $email = "";
            $website = "";
            $msg = "";
            $user_msg = "Message sent!";
        } catch (Exception $e) {
            error_log($e);
            $user_msg =  "Error while saving result to db. ".$e->getMessage();
        }
    } else {
        $user_msg = "Oops!! Something is wrong, check entered values";
    }
}

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Frontend Test</title>
    <meta name="description" content="Haha">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="css/main-min.css">
    <!--<link rel="stylesheet" href="css/main.css">-->
    <!--[if lt IE 9]>
        <script src="js/vendor/modernizr-2.6.2-custom.min.js"></script>
    <![endif]-->

    <!-- live reload snippet -->
    <!--<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>-->
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
                    <h2 class="icon-home"><a href="#">Lorme Ipsom Dolor</a></h2>
                    <p>Lorem Ipsum is simply dummy text of the
                        printing and typesetting industry. Lorem Ip unknown printer took a galley of type and</p>
                    <a href="#">see more..</a>
            </article>
            <article  >
                <h2 class="icon-paper"><a href="#">Lorme Ipsom Dolor</a></h2>
                    <p>Lorem Ipsum is simply dummy text of the
                        printing and typesetting industry. Lorem Ip unknown printer took a galley of type and</p>
                    <a href="#">see more..</a>
            </article>

            <article class="last">
                <h2 class="icon-bag"><a href="#">Lorme Ipsom Dolor</a></h2>
                    <p>Lorem Ipsum is simply dummy text of the
                        printing and typesetting industry. Lorem Ip unknown printer took a galley of type and</p>
                    <a href="#">see more..</a>
            </article>
        </div>
    </section>
    <section class="quick-contact-container wrapper clearfix">
        <form action="index.php#quick-contact-user-message" role="search" method="get" name="quickcontact" id="quickcontactform">
            <input type="hidden" name="q" value="save">

            <fieldset>
                <legend>Quick contact</legend>
                <div id="quick-contact-user-message"
                <?php
                    if ($messageSent) {
                ?>class="ok"
                <?php
                    } else if ($any_error) {
                ?>class="error"
                <?php
                    }
                ?>><?=$user_msg?>
                </div>
                <label for="quick-contact-msg" class="visuallyhidden">Write your message here</label>
                <textarea id="quick-contact-msg" <? if ($msg_error) {?>class="error"<?}?> name="<?=MSG?>" required="required" placeholder="Write your message here" title="Write your message here." tabindex="4"><?=$msg?></textarea>
                <label for="quick-contact-fullname" class="visuallyhidden">Name</label>
                <input class="text-input<? if ($fname_error) {?> error<?}?>" id="quick-contact-fullname" type="text" name="<?=FNAME?>" value="<?=$fname?>" placeholder="Name" title="Name" required="required" tabindex="1" />
                <label for="quick-contact-email" class="visuallyhidden">e-mail</label>
                <input class="text-input<? if ($email_error) {?> error<?}?>" id="quick-contact-email" type="email" name="<?=EMAIL?>" value="<?=$email?>" placeholder="e-mail" title="e-mail" required="required" tabindex="2" />
                <label for="quick-contact-website" class="visuallyhidden" >Website <abbr title="Uniform resource locator">URL</abbr></label>
                <input class="text-input<? if ($website_error) {?> error<?}?>" id="quick-contact-website" name="<?=WEBSITE?>" value="<?=$website?>" type="url" placeholder="Website URL" title="Website URL" required="required" tabindex="3" />
            </fieldset>

            <input class="submit" type="submit" title="Submit" value="SUBMIT" tabindex="5">

        </form>
    </section>
</div>
<!-- #main-container -->
<div class="footer-container">
    <footer class="wrapper">
        <span>&copy; MyFakeCompany</span> <a href="#" class="rss"><span>RSS</span></a>
    </footer>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.1.min.js"><\/script>')</script>

<script src="js/main-min.js"></script>
</body>
</html>
