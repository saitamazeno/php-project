<?php

function construct() {
    load_model('index');
    load('lib', 'validation');
    load('lib', 'email');
}

function loginAction() {
//    echo time();
//    echo date("d/m/Y h:m:s");
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

function logoutAction() {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
}

function resetAction() {
    load_view('reset');
}

function resetOkAction() {
    load_view('resetOk');
}

function updateAction() {
//    show_array($_SESSION);
//    Cập nhật tài khoản
//    B1: Tạo giao diện
//    B2: Load lại thông tin cữ
//    B3: Validation form 
//    B4: Cập nhật thông tin
    if (isset($_POST['btn-update'])) {
        show_array($_POST);
        $error = array();
        //Kiểm tra
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];
        if (empty($error)) {
            //update

            $data = array(
                'fullname' => $fullname,
                'address' => $address,
                'phone_number' => $phone_number
            );
//            show_array($data);
            update_user_login(user_login(), $data);
        }
    }
    $info_user = get_user_by_username(user_login());
//    show_array($info_user);
    $data['info_user'] = $info_user;
    load_view('update', $data);
}
