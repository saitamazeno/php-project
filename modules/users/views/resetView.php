<html>
    <head>
        <title>Khôi phục mật khẩu</title>
        <link href="public/css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/login.css" rel="stylesheet" type="text/css"/>        
    </head>
    <div id="wp-form-login">
        <h1 class="page-title">KHÔI PHỤC MẬT KHẨU</h1> 
        <form id="form-login" action="" method="POST">
            <input type="text" name="email" id="username" value="<?php echo set_value('mail') ?>" placeholder="Email"/>
            <?php echo form_error('email'); ?>
            <input type="submit" id="btn-login" name="btn-reset" value="GỬI YÊU CẦU"/>
            <?php echo form_error('account'); ?>
        </form>
        <a href="<?php echo base_url("?mod=users&action=login"); ?>" id="lost-pass">Đăng nhập</a> |
        <a href="<?php echo base_url("?mod=users&action=reg"); ?>" id="lost-pass">Đăng ký</a> 
    </div>
    <body>

    </body>
</html>


