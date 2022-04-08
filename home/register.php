<?
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Website bán thẻ điện thoại, thẻ game, dịch vụ nạp tiền đt online</title>
   <meta name="description" content='Website bán thẻ điện thoại, thẻ game, dịch vụ nạp tiền đt online' />
   <meta name="keywords" content='Website bán thẻ điện thoại, thẻ game, dịch vụ nạp tiền đt online' />
   <meta name="robots" content='noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe24h.vn" />
   <meta name="google-site-verification" content="aUx6ZWFKAWgafQ1QMy6iAhA6aqaiQpet7LOH2MZ8UMk" />
   <link rel="canonical" href='https://banthe24h.vn/' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
      <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="/css/style.min2.css" />
  <link rel="stylesheet" type="text/css" href="/css/responsive.css" />  
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/common.js"></script>
  <script src="/js/usermanager.js"></script>
</head>
<body style="cursor: pointer !important;">
   <!--header section work start-->        
   <? include("../includes/inc_header.php") ?>
   <div class="container">
    <div class="divcontent1"></div>
    <div class="row">
      <div class="col-md-8 col-xs-12 main-tintuc-left">
        <h1 class="page_title">Đăng kí tài khoản</h1>
        <div class="panel panel-default">
          <div class="panel-body">
            <form>
              <div class="form-group">
                <label class="control-label">Họ tên</label>
                <input type="text" id="ctrlhotentxt" name="txthoten" value="" class="form-control" placeholder="Họ tên" maxlength="50"> 
              </div>
              <div class="form-group">
                <label class="control-label">Số điện thoại</label>
                <input type="text" id="ctrlphonetxt" name="txtsdt" value="" class="form-control" placeholder="Số điện thoại" maxlength="12">
              </div>
              <div class="form-group">
                <label class="control-label" for="ctrlemailtxt">Địa chỉ email</label>
                <input type="email" id="ctrlemailtxt" name="txtemail" class="form-control" placeholder="Địa chỉ email" value=""> 
              </div>
              <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" id="ctrlpasstxt" name="txtpassword" class="form-control" placeholder="Mật khẩu"> 
              </div>
              <div class="form-group">
                <label class="control-label" for="ctrlrepasstxt">Nhập lại mật khẩu</label>
                <input type="password" id="ctrlrepasstxt" name="txtrepassword" class="form-control" placeholder="Mật khẩu"> 
              </div>
            </form>
          </div>
          <div class="form-inline">
            <div class="form-group">
              <div class="col-sm-12">
                <label>Nhập mã kiểm tra</label> 
                <input type="text" name="captcha" id="ValidateCode" class="inputcapchabox">
                <img id="captcha_code" src="/home/captcha_code.php" /><button name="submit" class="btnRefresh" onClick="refreshCaptcha();">Refresh Captcha</button> 
              </div>
            </div>


          </div>
          <div class="form-group"> </div>
          <br>
          <!--<div class="form-group">
            <div class="col-sm-12">Bằng cách nhấn vào "Đăng ký tài khoản", bạn đồng ý với <a href="#" target="_blank">Điều khoản &amp; Điều kiện</a> của chúng tôi và rằng bạn đã đọc <a href="#" target="_blank">chính sách bảo mật</a></div>
            <div class="clearfix"></div>
          </div>-->
          <div class="panel-footer">
            <button type="button" class="btn btn-primary" id="ctrregisterbtn"><i class="fa fa-sign-in"></i> Đăng ký tài khoản</button>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <?php include("../includes/inc_tin_tuc_right.php")?>
    </div>
  </div>
   
   <? include("../includes/inc_footer.php") ?>
</body>
</html>