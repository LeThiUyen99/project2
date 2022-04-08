<?
include("config.php");
if($logger != 1)
{
   redirect("/");
}
$userinfourl=$_SERVER['REQUEST_URI'];

$urluri="/rut-tien";
if($userinfourl != $urluri)
{
   header("HTTP/1.1 301 Moved Permanently"); 
   header("Location: $urluri");
   exit();
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Rút tiền về tài khoản ngân hàng | Doithe66.com</title>
   <meta name="description" content='Dịch vụ đổi thẻ trực tuyến - Đổi thẻ cào thành tiền mặt uy tín nhất, mức phí thấp nhất - Tiết kiệm - Nhanh chóng - An toàn. Hỗ trợ 24/7' />
   <meta name="keywords" content='doi the cao thanh tien, doi the cao, đổi thẻ cào, thu mua thẻ cào, thu mua the cao, đổi thẻ đện thoại, doi the dien thoai' />
   <meta name="robots" content='noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="doithe66.com" />
   <meta name="google-site-verification" content="aUx6ZWFKAWgafQ1QMy6iAhA6aqaiQpet7LOH2MZ8UMk" />
   <link rel="canonical" href='https://doithe66.com/' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
   <link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
   <link href="/css/grid-0.4.3.min.css" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" type="text/css" href="/css/site.css" />
   <link rel="stylesheet" type="text/css" href="/css/common.css?v=5" />
   <script src="/js/jquery-1.9.1.js"></script>
   <script src="/js/bootstrap.min.js"></script>    
   <script src="/js/bootstrap-datepicker.js"></script>    
   <script src="/js/grid-0.4.3.min.js" type="text/javascript"></script>   
   <script type="text/javascript" src="/js/crawler.js"></script>
   <script src="/js/Trans.js"></script>
   <script src="/js/usermanager.js?v=6"></script>
   <script src="/js/common.js"></script>
   <script src="/js/date.format.js"></script>
   <script type="text/javascript" src="/js/jquery.slicknav.js"></script>
</head>
<body style="cursor: pointer !important;">
   <!--header section work start-->        
   <? include("../includes/inc_header.php") ?>
   <div class="container mid_content">
      <div id="boxLoading" style="display:none;">
         <div class="overlay"></div>
         <div class="boxLoading">Working..</div>
      </div>
      <div>
          <? include("../includes/inc_box_center.php");?>  
          <div class="container">
              <div class="login_success">              
                    <div class="main_sc">
                        <div class="right_sc">
                            <section>
                            <div class="main_cate_page ruttiennews">
                                <div style="padding:0 10px;line-height:24px;">
                        <?
                         if($logger == 1)
                         {
                            if(isset($lg_userinfo['BankCode'])){
                         ?>
                                <div class="form-group" style="overflow:hidden;">
                                    <label class="control-label col-sm-2" for="ctrlAmounttxt" style="font-size:18px;"><b>Số tiền rút:</b></label>
                                    <div class="col-sm-6">
                                        <input type="text" id="ctrlAmounttxt" name="ctrlAmounttxt" class="form-control" placeholder="Bạn hãy nhập số tiền rút" value="">
                                    </div>
                                </div>
                             <div class="form-group" style="overflow:hidden;">
                                <label class="control-label col-sm-2" for="ctrlmatkhaucap2" style="font-size:18px;"><b>Mật khẩu cấp 2</b></label>
                                <div class="col-sm-6">
                                    <input type="password" autocomplete="" id="ctrlmatkhaucap2" name="ctrlmatkhaucap2" class="form-control" placeholder="Bạn hãy điền mật khẩu cấp 2" value="">
                                </div>
                            </div>
                                <div class="form-group" style="overflow:hidden;">
                                    <label class="control-label col-sm-2" for="ctrlAmounttxt" style="font-size:18px;"><b>Ghi chú:</b></label>
                                    <div class="col-sm-6">
                                        <textarea id="ctrlghichuruttien" name="ctrlghichuruttien" class="form-control" placeholder="Ghi chú"></textarea>
                                    </div>
                                </div>
                                <div class="clearfix" style="height:10px;"></div>
                                <div class="form-group" style="overflow:hidden;">
                                    <div class="col-sm-offset-2 col-sm-6">
                                        <button type="button" id="btnTaoLenhRutTien" class="btn btn-primary">Rút tiền</button>
                                    </div>
                                </div>
                            <?}
                            else
                            { ?>
                                <span>Bạn hãy cập nhật tài khoản ngân hàng!</span>
                            
                        <? } }else{ ?>
                            <div class="form-group" id="notifylogin">
                                <div class="label label-danger" id="msg_err_napthe">Bạn chưa đăng nhập!</div>
                            </div>
                        <? } ?>
                       </div>
                       </div>
                        </section>                        
                        </div>
                        <? include("../includes/inc_right_history.php"); ?>
                    </div>
              </div>
                
          </div>
          
      <!--right section work end-->  
      </div>
   </div>
   <? include("../includes/inc_footer.php") ?>
   <script type="text/javascript">
        $(document).ready(function () {
            $("#ctrlAmounttxt").numeric();
            var ht = new Ruttien();
        });
    </script>
</body>
</html>