<html>
    <head>
        <title>Hệ thống điều hướng cơ bản</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <a id="logo">UNITOP</a> 
                <?php if (is_login()) {
                ?>
                <!--                    <div id="user-login">
                                        <p>Xin chào <strong><?php // echo $_SESSION['user_login']  ?></strong>(<a href="?mod=users&action=logout">Thoát</a>)</p>
                                        <p>Xin chào <strong><?php // if(is_login()) echo info_user('fullname');  ?></strong>(<a href="?page=logout">Thoát</a>)</p>
                                    </div>-->
                <?php } ?>
                <div id="user-login">
                    <p>Xin chào <strong><?php echo $_SESSION['user_login']  ?></strong>(<a href="?mod=users&action=logout">Thoát</a>)</p>
                    <!--<p>Xin chào <strong><?php // if (is_login()) echo info_user('fullname'); ?></strong>(<a href="?page=logout">Thoát</a>)</p>-->
                </div>
                <ul id="main-menu">
                    <!--cách viết khác của pages/home.php tránh lặp cấu trúc-->
                    <li><a href="?page=home">Trang chủ</a></li>
                    <li><a href="?page=about">Giới thiệu</a></li>
                    <li><a href="?page=news">Tin tức</a></li>
                    <li><a href="?page=product">Sản phẩm</a></li>
                    <li><a href="?page=course">Khóa học</a></li>
                    <li><a href="?page=contact">Liên hệ</a></li>
                </ul>
            </div>