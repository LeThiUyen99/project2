<?
include("config.php");
$body = 'aaaaaaaaaaaaaaaaaaaaaaaaâaaaaaaaaaaaaaaaaaaaaaaaaâaaaaaaaaaaaaaaaaaaaaaaaaâaaaaaaaaaaaaaaaaaaaaaaaaâaaaaaaaaaaaaaaaaaaaaaaaaâaaaaaaaaaaaaaaaaaaaaaaaaâaaaaaaaaaaaaaaaaaaaaaaaaâaaaaaaaaaaaaaaaaaaaaaaaaâaaaaaaaaaaaaaaaaaaaaaaaaâ';
$body = mb_convert_encoding($body,'UTF-8');
$body = base64_encode($body);
echo CreateSendMail("danganhtucode@gmail.com","danganhtucode@gmail.com","","","[doithe66] - Xác nhận lấy lại mật khẩu",$body,"MUA_MA_THE");
?>