<?
include("config.php");
$newid = getValue("newid","int","GET",0);
$newid = (int)$newid;

if($newid > 0)
{
   $db_qr1 = new db_query("SELECT Id,articles.categoryid,ImageUrl,Intro,articles.Description,Title,categoryname,ShortTitle,articles.Meta,PublicDate,articles.MetaDesc
                                         FROM articles 
                                         LEFT JOIN categories ON articles.categoryid = categories.categoryid
                                         WHERE IsActive = 1 AND id = $newid");
//var_dump(mysql_num_rows($db_qr1->result));die();
   if(mysql_num_rows($db_qr1->result) > 0)
   {

      $row1 = mysql_fetch_assoc($db_qr1->result);
      if($row1['ShortTitle'] != NULL)
      {
         $urlshort = $row1['ShortTitle'];
      }
      else
      {
         $urlshort = $row1['Title'];
      }
      $urlcano = $urlwebsite.rewrite_news($newid,$urlshort,$row['categoryname']);
      $userinfourl=$_SERVER['REQUEST_URI'];

      $src=$row1['ImageUrl'];
      if(strpos($row1['ImageUrl'],'/upload/') === false){
         $src="https://banthe24h.vn/pictures/news/".$row['ImageUrl'];
      }       
      
//echo $userinfourl;
$urlfull= $urlwebsite.$userinfourl;
//var_dump($urlfull);

if($urlfull != $urlcano)
{
   header("HTTP/1.1 301 Moved Permanently"); 
   header("Location: $urlcano");
   exit();
}
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
?>
<!DOCTYPE html>
<html>

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title><?= $row1['Title'] ?></title>
   <meta name="description" content='<?= $row1['MetaDesc'] ?>' />
   <meta name="keywords" content='<?= $row1['Meta'] ?>' />
   <meta name="robots" content='noodp,index,follow' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta name='revisit-after' content='1 days' />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="new_item" />
   <meta name="google-site-verification" content="BiFRC7mAFeY-M7x3tM-xwZQKhNIrDVkBgahKnZrEplU" />
   <link rel="canonical" href='<?= $urlcano ?>' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />


   <meta property="og:image:url" content="<?= $src ?>">
   <meta property="og:image:width" content="476">
   <meta property="og:image:height" content="249">
   <meta property="og:title" itemprop="headline" content="<?= $row1['Title'] ?>">
   <meta property="og:url" itemprop="url" content="<?= $urlcano ?>">
   <meta property="og:description" itemprop="description" content='<?= $row1['MetaDesc'] ?>'>
   <meta property="og:type" content="website">
   <meta property="og:locale" content="vi_VN">
   <meta name="twitter:card" content="summary" />
   <meta name="twitter:image" content="<?= $src ?>">
   <meta name="twitter:description" content="<?= $row1['MetaDesc'] ?>">
   <meta name="twitter:title" content="<?= $row1['Title'] ?>">
   <meta name="twitter:site" content="banthe24h.vn">


   <link rel="stylesheet" href="/css/bootstrap.min.css">
   <link media="screen" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" />
   <link rel="stylesheet" type="text/css" href="/css/style.min2.css?v=2" />
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
            <? include("../includes/inc_main_detail.php") ?>
         </div>
         <?php include("../includes/inc_tin_tuc_right.php") ?>
      </div>
   </div>
   <? include("../includes/inc_footer.php") ?>
</body>

</html>