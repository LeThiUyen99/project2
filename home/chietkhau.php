<? include("config.php") ?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Bảng chiết khấu mua thẻ tại banthe24h</title>
   <meta name="description" content='Bảng chiết khấu mua thẻ điện thoại, mua thẻ game tại website Banthe24h.vn. Mua thẻ online với chiết khấu ưu đãi nhất trên thị trường tại Banthe24h.vn' />
   <meta name="keywords" content='Chiết khấu mua thẻ điện thoại, chiết khấu mua thẻ game' />
   <meta name="robots" content='noindex,nofollow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe24h.vn" />
   <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
   <link rel="canonical" href='https://banthe24h.vn/chiet-khau' />
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
                           <div class="col-md-12 col-sm-12">
                          <?
$db_qr = new db_query("SELECT * FROM `newstable` WHERE Type = '99' AND IsActive='1'");
if(mysql_num_rows($db_qr->result) > 0)
    {
        $row=mysql_fetch_assoc($db_qr->result);
?>
<div style="float:left;width:100%;">
            <?=$row['Description']?>
        </div>
<?  }
?>
      </div>
      </div>
      <?php include("../includes/inc_tin_tuc_right.php")?>
    </div>
    </div>  
   <? include("../includes/inc_footer.php") ?>
</body>
</html>