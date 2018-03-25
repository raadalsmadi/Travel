<?php session_start(); ob_start(); require_once "connect.php";require_once "functions.php"?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo isset($pageTitle) ? $pageTitle : "Travel"?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
      <a class="navbar-brand" href="index.php" style="color:rgba(52, 152, 219,1.0)" >Travel</a>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php
                if(isset($_SESSION['roles']) && $_SESSION['roles'] == 1 ){ ?>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li> <a  href="addTravel.php">رحلات</a></li>
                            <li> <a  href="addTravel.php?view=add"> اضافه رحلات</a></li>
                            <li> <a  href="addCategory.php">عرض صنف رحلات</a></li>
                            <li> <a  href="addCategory.php?view=add">اضافه صنف رحلات</a></li>
                            <li><a  href="showtravel.php">رحلات المحجوزة</a></li>
                            <li><a  href="users.php">المستخدمين</a></li>
                        </ul>
                    </li>
                <?php }
                ?>
                <li><a href="index.php">الرئسية</a></li>
                     <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> الرحلات
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
                <?php
                $cats = getCategoriesToMain();
                foreach ($cats as $cat) {
                    echo "<li><a href='./showAllTravelInCategory.php?cat_name=".str_replace(" ","-",$cat['cat_name'])."' >".$cat['cat_name']."</a></li>";
                }
                ?>
        </ul>
      </li>


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if(!isset($_SESSION['login']) || $_SESSION['login'] !== true)
                { ?>
                    <li><a href="login.php">دخول <i class="fa fa-sign-in"></i> </a></li>
                    <li><a href="register.php">تسجيل <i class="fa fa-sign-in"></i> </a></li>
                <?php }else{
                ?>
                    <li class="dropdown">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="logout.php">تسجيل الخروج</a></li>
                            <li><a href="profile.php">الملف الشخصي</a></li>
                        </ul>
                    </li> <?php }?>
                <!--<li class="dropdown">
                <?php echo $_SESSION['username']?><i class="fa fa-angle-down"></i>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php">تسجيل الخروج</a></li>
                        <li><a href="profile.php">الملف الشخصي</a></li>
                    </ul>
                </li>-->
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>