<?
include("config.php");

      $urlcano = $urlwebsite.'/giai-quyet-khieu-nai';
      $userinfourl=$_SERVER['REQUEST_URI'];
      
//echo $userinfourl;
$urlfull= $urlwebsite.$userinfourl;
//var_dump($urlfull);
//var_dump($urlcano);die();
if($urlfull != $urlcano)
{
   header("HTTP/1.1 301 Moved Permanently"); 
   header("Location: $urlcano");
   exit();
}

?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>banthe247.com - Giải quyết khiếu nại</title>
   <meta name="description" content='Khi phát sinh vấn đề trục trặc trong giao dịch. Mọi khiếu nại xin quý khách vui lòng liên hệ với hotline hoặc gửi mail cho chúng tôi' />
   <meta name="keywords" content='bán thẻ điện thoại online, bán thẻ game online, nạp thẻ online, nạp thẻ trực tuyến, đổi thẻ mới, nap the online uy tin, bán thẻ gate online, bán thẻ zing online' />
   <meta name="robots" content='noodp,index,follow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="new_item" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <link rel="canonical" href='<?= $urlcano ?>' />
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
           <h3 class="page_titel">Giải quyết khiếu nại</h3> <div class="news-content"> <div class="article"> <span class="subtitle">Banthe24h.vn xin chân thành cảm ơn quý khách hàng đã lựa chọn và sử dụng dịch vụ của chúng tôi!</span> <h1 class="title">Banthe24h.vn là cổng thanh toán trực tuyến chuyên cung cấp các dịch vụ trực tuyến, thanh toán online ...</h1> <div style="text-align: justify;"> <h2>Trong quá trình sử dụng các dịch vụ nếu có vướng mắc, yêu cầu gì xin vui lòng liên hệ với chúng tôi: </h2> <p>- Chủ đề email: [Khiếu nại] [Vấn đề cần được giải quyết], ví dụ: [Khiếu nại] Tôi chưa nhận được mã thẻ cào dù đã thanh toán tiền.</p> <p>- Nội dung email cần cung cấp đầy đủ các thông tin sau:</p> <p>+ Họ và Tên. </p> <p>+ Số điện thoại liên hệ.</p> <p>+ Nêu rõ vấn đề cần khiếu nại.</p> <span class="subtitle">Gửi email về địa chỉ <a style="color:red">info@24hpay.vn</a>.</span> </div> <span class="subtitle">Banthe24h Xin cảm ơn!</span> <div class="clearThis"> </div> </div> </div> 
        
      </div>
      <?php include("../includes/inc_tin_tuc_right.php")?>
        </div>
      </div>
   <? include("../includes/inc_footer.php") ?>
</body>
</html>