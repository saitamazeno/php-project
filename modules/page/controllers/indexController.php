<?php
//ta có rất nhiều action khác nhau như thêm sửa xóa lấy ra
function construct() {

}

function indexAction() {
    load_view('index');
}
function detailAction() {
    echo $_GET['slug'];
    load_view('index');
}
function addAction() {

}

function editAction() {

}
