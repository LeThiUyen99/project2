<?php  session_start();

// Lấy thông tin
$captcha = isset($_POST['captcha']) ? $_POST['captcha'] : false;

// Biến lưu kết quả trả về
$error = array(
    'error'     => 'success',
    'captcha'   => ''
);

// Kiểm tra captcha
if (!$captcha){
    $error['captcha'] = 'Bạn chưa nhập mã bảo mật';
    $error['error'] = 'error';
}
else if (!isset($_SESSION['captcha_code']) || $_SESSION['captcha_code'] != trim($captcha)) {
    $error['captcha'] = 'Mã bảo mật không chính xác';
    $error['error'] = 'error';
}

// Trả kết quả cho client
die (json_encode($error));
?>
