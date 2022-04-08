<?
$emailtemplate = '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>['.$domain.'] - Xác nhận đăng ký tài khoản</title>
</head><body><div style="width: 800px; margin: 0 auto;font-size:14px; background-color: #fff; border: 1px solid #cccccc; ">
<div style="padding:7px 15px;"><div style="padding: 5px 0px 7px 0px; border-bottom: 5px solid #d3e2ff;margin-bottom:25px;">
'.strtoupper($domain).'</div><b>Xác thực tài khoản email đăng ký trên '.$domain.'</b><br><br><p>Xin chào <b>'.$Name.'</b>,</p>
<br>Bạn đã đăng ký thành công tài khoản tại website '.$domain.' bằng email: <strong>'.$Email.'</strong><br />
để hoàn tất việc đăng ký thành viên, bạn phải Click vào đường link dưới đây để kích hoạt thành công tài khoản.<br /><br />
<br /><a style="font-size:16px" target="_blank" href="'.$urlwebsite.'/User/ComfirmUserRegister?c='.$comfirmcode.'&u='.$Email.'">Link kích hoạt tài khoản</a>
<br /><div style="text-align:center;width:100%; font-size:22px;color:#fff;"><strong>'.$comfirmcode.'</strong></div><br /></div><div style="padding:7px 15px;"><p><b>Cảm ơn bạn đã sử dụng dịch vụ của Chúng tôi</b></p><p style="line-height:25px;">Để biết thêm chi tiết về dịch vụ hoặc đóng góp ý kiến cho Chúng tôi, Quý khách vui lòng liên hệ qua số điện thoại: '.$phonewebsite.' hoặc Email: '.$emailwebsite.'</p>
<p>Trân trọng,</p><p><b>'.$domain.'</b></p></div></div></body></html>';
?>