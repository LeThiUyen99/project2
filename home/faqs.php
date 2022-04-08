<?
include("config.php");
$newid = getValue("newid","int","GET",0);
$newid = (int)$newid;
//var_dump($newid);die();
if($newid > 0)
{
   $db_qr1 = new db_query("SELECT * FROM faqs Where FaqID = $newid LIMIT 1");
   if(mysql_num_rows($db_qr1->result) > 0)
   {
      $row1 = mysql_fetch_assoc($db_qr1->result);
      $urlcano = $urlwebsite.rewrite_news($newid,$row1['Title'],"chuyen-muc-hoi-dap");
      $urlamp = $urlwebsite.rewrite_news($newid, $row1['Title'],"amp-chuyen-muc-hoi-dap");
   }
   else
   {
      redirect("/");
   }
$indexfoloow="noodp,index,follow";
// if($newid==1017 || $newid==14 || $newid==15 || $newid==5 || $newid==7 || $newid==6){
// $indexfoloow="noodp,noindex,nofollow";
// }
}
else
{
   redirect("/");
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title><?= $row1['Title'] ?></title>
   <meta name="description" content='<?= trim(removeHTML($row1['Answer'])) ?>' />
   <meta name="keywords" content='<?= $row1['MetaKeyword']!=NULL?$row1['MetaKeyword']:"Thu mua thẻ cào điện thoại, thẻ cào game với chiết khấu ưu đãi nhất cho khách hàng tới trên 87,5% , Mua thẻ điện thoại, thẻ game nhanh chóng, tiết kiệm." ?>' />
   <meta name="robots" content='<?=$indexfoloow ?>' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe24h.vn" />
   <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
   <link rel="canonical" href='<?= $urlcano ?>' />
   <link rel="amphtml" href="<?=$urlamp ?>" />
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
            <div class="news-content">
               
                        <? include("../includes/inc_main_faq.php") ?>
                    
               
            </div>
         </div>
         <?php include("../includes/inc_tin_tuc_right.php")?>
      </div>
   </div>
   <? include("../includes/inc_footer.php") ?>
</body>
</html>