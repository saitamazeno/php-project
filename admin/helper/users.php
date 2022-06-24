<?php

//trả về true nếu đã login
function is_login(){
    if(isset($_SESSION['is_login']))
        return true;
    return false;
}
//trả về username của người login
function user_login(){
    if(!empty($_SESSION['user_login'])){
        return $_SESSION['user_login'];
    }
    return FALSE;
}

