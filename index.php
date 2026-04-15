<?php 

session_start();

spl_autoload_register(function ($class) {    
    $fileName = "$class.php";

    $fileModel              = PATH_MODEL . $fileName;
    $fileControllerClient         = PATH_CONTROLLER_CLIENT . $fileName;
    $fileControllerAdmin         = PATH_CONTROLLER_ADMIN . $fileName;

    if (is_readable($fileModel)) {
        require_once $fileModel;
    } 
    else if (is_readable($fileControllerClient)) {
        require_once $fileControllerClient;
    }
    else if (is_readable($fileControllerAdmin)) {
        require_once $fileControllerAdmin;
    }
});

require_once './configs/env.php';
require_once './configs/helper.php';

// Điều hướng
$mode = $_GET['mode'] ?? 'client';

if ($mode == 'client') {
    # require điều hướng client
    require_once './routes/client.php';
} else {
    // Kiểm tra đang nhập tài khoản có quyền admin hay không
    // Nếu không có quyền admin đẩy sang routes của client
    # require điều hướng của admin
    require_once './routes/admin.php';
}
