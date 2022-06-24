<?php

function construct() {
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function regAction() {
    global $error, $username, $password, $email, $fullname;
//    echo send_mail('vanhau100375@gmail.com', "Nguyễn Văn Hậu", 'Kích hoạt tài khoản', "<a href='http://unitop.vn'>Kích hoạt</a>");
    if (isset($_POST['btn-reg'])) {
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống tên đăng nhập";
        } else {
            $fullname = $_POST['fullname'];
        }
        #Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        #Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }
        #kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }
        #Kết luận 
        if (empty($error)) {
            if (!user_exists($username, $email)) {
                $active_token = md5($username.time());
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'active_token' => $active_token,
//                    'reg_date' => time()
                );
                add_user($data); 
                $link_active = base_url("?mod=users&action=active&active_token={$active_token}");
                $content = "<p>Chào bạn {$fullname}</p>
                            <p>Bạn vui lòng click vào đường link này để kích hoạt tài khoản: {$link_active}</p> 
                            <p>Nếu không phải bạn đăng ký tài khoản thì hãy bỏ qua email này</p> 
                            <p>Team Support Unitop.vn</p>";
                send_mail('vanhau100375@gmail.com', "Nguyễn Văn Hậu", 'Kích hoạt tài khoản PHP MASTER', $content);
                
                //Thông báo
//                redirect("?mod=users&action=login");
            } else {
                $error['account'] = "Email hoặc username đã tồn tại trên hệ thống";
            }
        }
//        #Kết luận
//        if (empty($error)) {
//            if (check_login($username, $password)) {
////                Lưu trữ phiên đăng nhập 
//                $_SESSION['is_login'] = true;
//                $_SESSION['user_login'] = $username;
////                Chuyển hướng vào trong hệ thống 
//                redirect();
//            } else {
//                $error['account'] = "Tên đăng nhập hoặc mật khẩu không tồn tại";
//            }
//        }
}
    load_view('reg');
}

function loginAction() {
    global $error, $username, $password;
    if (isset($_POST['btn-login'])) {
        $error = array();
        #Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        #Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }
        if (empty($error)) {
            if (check_login($username, $password)) {
//                Lưu trữ phiên đăng nhập
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
//                chuyển hướng vào trong hệ thống
                redirect();
            } else {
                $error['account'] = "Tên đăng nhập hoặc mật khẩu không tồn tại";
            }
        }
    }
    load_view('login');
}

function activeAction() {
    $link_login = base_url("?mod=users&action=login");
    $active_token = $_GET['active_token'];
//    echo $active_token;
//    echo active_user($active_token);
    if (check_active_token($active_token)) {
        active_user($active_token);
        echo "Bạn đã kích hoạt thành công, vui lòng click vào đây để đăng nhập: <a href ='{$link_login}'>Đăng nhập</a>";
    } else {
        echo"Yêu cầu kích hoạt không hợp lệ hoặc tài khoản đã được kích hoạt trước đó!, vui lòng click vào đây để đăng nhập: <a href ='{$link_login}'>Đăng nhập</a>";
    }
}

function logoutAction() {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
}

function resetAction() {
    global $error, $username, $password;
    $reset_token = $_GET['reset_token'];
    if (!empty($reset_token)) {
        if (check_reset_token($reset_token)) {
            if (isset($_POST['btn-new-pass'])) {
                $error = array();
                #Kiểm tra password
                if (empty($_POST['password'])) {
                    $error['password'] = "Không được để trống mật khẩu";
                } else {
                    if (!is_password($_POST['password'])) {
                        $error['password'] = "Mật khẩu không đúng định dạng";
                    } else {
                        $password = md5($_POST['password']);
                    }
                }
                if (empty($error)) {
                    $data = array(
                        'password' => $password
                    );
                    update_pass($data, $reset_token);
                    redirect("?mod=users&action=resetOk");
                }
            }
//            echo"Hiển thị form";
            load_view('newPass');
        } else {
            echo"Yêu cầu lấy lại mật khẩu không hợp lệ";
        }
    } else {
        if (isset($_POST['btn-reset'])) {
            $error = array();
            #kiểm tra email
            if (empty($_POST['email'])) {
                $error['email'] = "Không được để trống email";
            } else {
                if (!is_email($_POST['email'])) {
                    $error['email'] = "Email không đúng định dạng";
                } else {
                    $email = $_POST['email'];
                }
            }
            #Kết luận
            if (empty($error)) {
                if (check_email($email)) {
//                echo"Email có tồn tại"; 
                    $reset_token = md5($email.time());
                    $data = array(
                        'reset_token' => $reset_token
                    );
                    //cập nhật mã reset pass cho user cần khôi phục lại mật khẩu
                    update_reset_token($data, $email);
                    //gửi link khôi phục vào email của người dùng
                    $link = base_url("?mod=users&action=reset&reset_token={$reset_token}");
                    $content = " <p>Bạn vui lòng click vào link sau để khôi phục mật khẩu:{$link}</p>
                    <p>Nếu không phải yêu cầu của bạn, bạn vui lòng bỏ qua email này</p>
                    <p>Unitop Team Support</p>";
                    send_mail($email, '', 'Khôi phục mật khẩu PHP MASTER', $content);
                } else {
                    $error['account'] = "Email không tồn tại trên hệ thống";
                }
            }
        }
        load_view('reset');
    }
}

function resetOkAction() {
    load_view('resetOk');
}
