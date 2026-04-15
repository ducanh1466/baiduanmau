<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new ProductController)->index(),
    'product-list' => (new ProductController)->index(), // Hiển thị trang danh sách sản phẩm
    'product-show'  => (new ProductController)->show(), // Hiển thị trang chi tiết sản phẩm
    'product-create' => (new ProductController)->create(), // Hiển thị trang tạo mới sản phẩm
    'product-edit' => (new ProductController)->edit(), // Hiển thị trang cập nhật sản phẩm
    'product-delete' => (new ProductController)->delete(), // Xóa sản phẩm
    'product-store' => (new ProductController)->store(), // Thực hiện chức năng lưu dữ liệu
    'product-update' => (new ProductController)->update(), // Thực hiện chức năng
   
};