<? 
include("config.php");
$page  = getValue('page','int','GET',1,2);
$page  = intval(@$page);
$curentPage = 10;
$pageab = abs($page - 1);
$start = $pageab * $curentPage;
$start = intval(@$start);
$start = abs($start);
if($page == 0)
{
   $page = 1;
}
$db_qrcat = new db_query("SELECT * FROM faqs ORDER BY CreateDate DESC LIMIT ".$start.",".$curentPage);
$numrow = new db_query("SELECT count(1) FROM faqs"); 
$count = mysql_fetch_assoc($numrow->result);
$count = $count['count(1)'];
$pageccr = $count/$curentPage;
$pageccr =  ceil($pageccr);
$urlcano = $urlwebsite."/chuyen-muc-hoi-dap";
$urlamp = $urlwebsite."/amp-chuyen-muc-hoi-dap";
if($page == 1)
{
   $url_r = $urlwebsite."/chuyen-muc-hoi-dap";
}
else if($page > 1)
{
   $url_r = $urlwebsite."/chuyen-muc-hoi-dap?page=".$page;
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
   <title>Chuyên mục hỏi đáp những thắc mắc của website Banthe247.com</title>
   <meta name="description" content='Chuyên mục hỏi đáp hỗ trợ khách hàng, trả lời các thắc mắc, ý kiến khách hàng của Banthe247.com một cách chính xác nhất. Giải đáp những thắc mắc của khách hàng' />
   <meta name="keywords" content='Chuyên mục hỏi đáp' />
   <meta name="robots" content='noodp,index,follow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
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
   <style type="text/css">
    .tt{
      background: #00a8ef;
      border-radius: 5px;
    }
    .tt .dropdown-toggle{
      color: #fff !important;
    }
  </style>
</head>
<body style="cursor: pointer !important;">
   <!--header section work start-->        
   <? include("../includes/inc_header.php") ?>
   <div class="container">
    <div class="divcontent1"></div>
    <div class="row">
        <div class="col-md-12 col-xs-12 main-tintuc-left">
            <h1 class="page_title">Danh sách hỏi đáp</h1>
            <div class="list_title">
            <? include("../includes/inc_main_faqs.php") ?>
            </div>
        </div>
        
    </div>
    </div>

   <? include("../includes/inc_footer.php") ?>
</body>
</html>