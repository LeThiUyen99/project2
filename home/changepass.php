<?
include("config.php");
if($logger != 1)
{
   redirect("/");
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Đổi mật khẩu | banthe24h</title>
   <meta name="description" content='Dịch vụ đổi thẻ trực tuyến - Đổi thẻ cào thành tiền mặt uy tín nhất, mức phí thấp nhất - Tiết kiệm - Nhanh chóng - An toàn. Hỗ trợ 24/7' />
   <meta name="keywords" content='doi the cao thanh tien, doi the cao, đổi thẻ cào, thu mua thẻ cào, thu mua the cao, đổi thẻ đện thoại, doi the dien thoai' />
   <meta name="robots" content='noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe24h" />
   <meta name="google-site-verification" content="aUx6ZWFKAWgafQ1QMy6iAhA6aqaiQpet7LOH2MZ8UMk" />
   <link rel="canonical" href='http://localhost:8888/user/index' />
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
      <div>
         <section>
            <div class="main_cate_page">
               <div class="container">
                  <div class="changepassword">
                     <h1 class="text-head">Đổi mật khẩu</h1>
                     <div class="changepass">
                        <form class="form-horizontal" role="form">
                           <div class="alert alert-danger" id="divnotify"> <i class="fa fa-info-circle fa-lg"></i> <span></span> </div>
                           <div class="form-group">
                              <label for="inputPassword3" class="col-sm-2 control-label">Mật khẩu hiện tại<span class="asterisk_input"></span></label> 
                              <div class="col-sm-6"> <input type="password" name="old_possword" class="form-control" id="old_possword" placeholder="Mật khẩu hiện tại" autocomplete="off" tabindex="1" title=""> </div>
                           </div>
                           <div class="form-group">
                              <label for="new_password" class="col-sm-2 control-label">Mật khẩu mới<span class="asterisk_input"></span></label> 
                              <div class="col-sm-6"> <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Mật khẩu mới" autocomplete="off" tabindex="2" title=""> </div>
                           </div>
                           <div class="form-group">
                              <label for="repeat_new_password" class="col-sm-2 control-label">Xác nhận mật khẩu mới<span class="asterisk_input"></span></label> 
                              <div class="col-sm-6"> <input type="password" name="repeat_new_password" class="form-control" id="repeat_new_password" placeholder="Xác nhận mật khẩu mới" autocomplete="off" tabindex="3" title=""> </div>
                           </div>
                           <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-6"> <button type="button" class="btn btn-primary" tabindex="4" id="ctrlbtnchangpasstpass"> Thay đổi mật khẩu &nbsp; <i class="icon ion-log-in"></i> </button> </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      <!--right section work end-->  
      </div>
   </div>
   <? include("../includes/inc_footer.php") ?>
</body>
</html>