<? 
include("config.php");
$catid = getValue("catid","int","GET",0);
$catid = (int)$catid;
$page  = getValue('page','int','GET',1,2);
$page  = intval(@$page);
$curentPage = 10;
$pageab = abs($page - 1);
$start = $pageab * $curentPage;
$start = intval(@$start);
$start = abs($start);
$indexfoloow="noodp,index,follow";
if($page == 0)
{
   $page = 1;
}
if($page> 1){
    $indexfoloow="noodp,noindex,nofollow";
}
if($catid==8 || $catid==1 || $catid==6 || $catid==5){
$indexfoloow="noodp,noindex,nofollow";
}
if($catid > 0)
{
   $qrinfo = new db_query("SELECT * FROM categories WHERE CategoryID = $catid LIMIT 1");
   if(mysql_num_rows($qrinfo->result) > 0)
   {
      $rowinfo = mysql_fetch_assoc($qrinfo->result);
      $db_qrcat = new db_query("SELECT Id,articles.categoryid,PublicDate,articles.Intro,articles.MetaDesc,ImageUrl,Title,categoryname,ShortTitle
                             FROM articles 
                             LEFT JOIN categories ON articles.categoryid = categories.categoryid
                             WHERE IsActive = 1 AND articles.categoryid = $catid 
                             ORDER BY Id DESC LIMIT ".$start.",".$curentPage);
      $numrow = new db_query("SELECT count(1) FROM articles 
                              LEFT JOIN categories ON articles.categoryid = categories.categoryid
                              WHERE IsActive = 1 AND articles.categoryid = $catid"); 
   }
   else
   {
      redirect("/");
   }
}
else
{
   redirect("/");
}
$count = mysql_fetch_assoc($numrow->result);
$count = $count['count(1)'];
$pageccr = $count/$curentPage;
$pageccr =  ceil($pageccr);
$title = $rowinfo['CategoryName']." banthe247.com";
$desc=$rowinfo['CategoryName']." banthe247.com";
if($catid==1){
    $title="Tin tức dịch vụ cập nhật nhanh chóng, hữu ích | Banthe247.com";
    $desc="Tin tức liên quan đến các gói dịch vụ của nhà mạng di động. Tin tức mua thẻ điện thoại cập nhật thường xuyên, liên tục, nhanh chóng nhất chỉ có tại Banthe247.com";
}else if($catid==5){
    $title="Hướng dẫn sử dụng các dịch vụ nhà mạng | Banthe247.com";
}
$urlcano = $urlwebsite.rewriteNews($catid,$rowinfo['CategoryName']);
if($page == 1)
{
   $url_r = $urlwebsite.rewriteNews($catid,$rowinfo['CategoryName']);
   $title = $rowinfo['CategoryName'] . " banthe247.com";
}
else if($page > 1)
{
   $title = $rowinfo['CategoryName']." banthe247.com ,trang ".$page;
   $url_r = $urlwebsite.rewriteNews($catid,$rowinfo['CategoryName'])."?page=".$page;
}
$urluri = $urlwebsite.$_SERVER['REQUEST_URI'];
if($url_r != $urluri)
{
   header("HTTP/1.1 301 Moved Permanently"); 
   header("Location: $url_r");
   exit();
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title><?= $title ?></title>
   <meta name="description" content='<?= $rowinfo['MetaDesc']!=null?$rowinfo['MetaDesc']:'Thu mua thẻ cào điện thoại, thẻ cào game trực tuyến giá tốt nhất, thanh toán nhanh chóng, tiện lợi nhất. Địa chỉ thu mua card diện thoại online, uy tín.' ?>' />
   <meta name="keywords" content='<?= $rowinfo['Meta']!=null?$rowinfo['Meta']:'thu mua the cao, thu mua thẻ cào, thu mua thẻ điện thoại, thu mua card, thu mua card điện thoại, thu mua thẻ cào trực tuyến, thu mua mã thẻ' ?>' />
   <meta name="robots" content='<?=$indexfoloow ?>' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
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
      <div class="col-md-12 col-xs-12 main-tintuc-left">
        <? include("../includes/inc_main_cate.php") ?>
        
      </div>
      
        </div>
      </div>
   
   <? include("../includes/inc_footer.php") ?>
</body>
</html>