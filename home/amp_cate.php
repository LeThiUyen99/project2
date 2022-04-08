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
$indexfoloow="noodp,index,follow";
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

?>
<!DOCTYPE html>
<html amp lang="vi">
<head>
    <meta charset="UTF-8">
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    <script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <title><?= $title ?></title>
   <meta name="description" content='<?= $rowinfo['MetaDesc']!=null?$rowinfo['MetaDesc']:'Thu mua thẻ cào điện thoại, thẻ cào game trực tuyến giá tốt nhất, thanh toán nhanh chóng, tiện lợi nhất. Địa chỉ thu mua card diện thoại online, uy tín.' ?>' />
   <meta name="keywords" content='<?= $rowinfo['Meta']!=null?$rowinfo['Meta']:'thu mua the cao, thu mua thẻ cào, thu mua thẻ điện thoại, thu mua card, thu mua card điện thoại, thu mua thẻ cào trực tuyến, thu mua mã thẻ' ?>' />
   <meta name="robots" content='<?=$indexfoloow ?>' />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   <meta http-equiv="content-language" content="vi" />
   <meta name="author" itemprop="author" content="banthe247.com" />
   <meta name="google-site-verification" content="fmFRqqkIuPsEVoVuiH5ALglJ_vG-1oGXy9ZAvb3ht48" />
   <link rel="canonical" href='<?= $urlcano ?>' />
   <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
   <style amp-custom>
        @font-face{font-family:Roboto,sans-serif;src:url(roboto/Roboto-Regular.ttf);font-display:swap}@font-face{font-family:Roboto-Medium,sans-serif;src:url(roboto/Roboto-Medium.ttf);font-display:swap}@font-face{font-family:Roboto-Bold,sans-serif;src:url(roboto/Roboto-Bold.ttf);font-display:swap}.reg{float:left;width:100%;background:#0098db}.mxh{float:right;padding:5px}.hotline{color:#fff;font-size:14px;font-family:Roboto,sans-serif}.sky{background:url(/images/skype.png) no-repeat left;padding-left:25px;color:#337ab7;font-size:14px;font-family:Roboto,sans-serif}.menu{background:#f8f8f8;padding:0 15px}#showMenu{float:right;border:1px solid #e75a1d;background:#e75a1d;border-radius:5px;padding:5px 10px;margin-top:10px}.icon-bar{width:22px;height:2px;background-color:#fff;margin:4px 0}.menu-nav{float:right;font-weight:700;margin-right:5px;margin-top:5px}.menu ul{padding-top:30px;padding-left:10px}.menu ul li{list-style-type:none;padding:7px 0}.menu ul li a{font-size:15px;padding:7px 10px;color:#777;font-weight:400;font-family:Roboto;line-height:20px}.container1{display:flex;width:100%}.row1{width:95%;margin:auto}.page_title{margin-top:5px;margin-bottom:20px;padding-bottom:4px;color:#666;border-bottom:1px dashed #ccc;font-family:Roboto,sans-serif;font-weight:500}.new_item{padding-top:20px;padding-bottom:20px;height:auto;border-bottom:1px solid #ccc;margin-bottom:10px}.new_item_img{position:relative;min-height:1px;padding-right:15px;padding-left:15px}.thumbnail{display:block;padding:4px 30px;margin-bottom:20px;line-height:1.42857143;background-color:#fff;border:1px solid #ddd;border-radius:4px;transition:border .2s ease-in-out;height:100%}.new_title{position:relative;min-height:1px;padding-right:15px;padding-left:15px;max-height:150px;overflow:hidden}.heading_title{padding:0;margin:0;font-size:18px;font-weight:700;line-height:22px;margin-bottom:7px;font-family:Roboto,sans-serif}.new_item .heading_title a{color:#222}.box-meta{position:relative;top:1px;display:inline-block;font-family:Roboto,sans-serif;font-style:normal;font-weight:400;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;font-size:14px;color:#333;line-height:1.42857143}.far{display:inline-block;font:normal normal normal 14px/1 FontAwesome;font-size:inherit;text-rendering:auto;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;padding-right:5px}.fa-clock:before{content:"\f017"}.title{text-align:justify;font-family:Roboto,sans-serif;font-size:14px;color:#333;line-height:1.42857143}.pagination{display:inline-block;padding-left:0;margin:20px 0;border-radius:4px}.col-sm-12{text-align:right;position:relative;min-height:1px;padding-right:15px;padding-left:15px}.pagination > li{display:inline}.pagination > li:first-child > a,.pagination > li:first-child > span{margin-left:0;border-top-left-radius:4px;border-bottom-left-radius:4px;position:relative;float:left;padding:6px 12px;line-height:1.42857143;text-decoration:none;border:1px solid #ddd}.pagination > li > a,.pagination > li > span{position:relative;float:left;padding:6px 12px;margin-left:-1px;line-height:1.42857143;color:#337ab7;text-decoration:none;background-color:#fff;border:1px solid #ddd;font-family:Roboto,sans-serif}.pagination > .active > a,.pagination > .active > a:focus,.pagination > .active > a:hover,.pagination > .active > span,.pagination > .active > span:focus,.pagination > .active > span:hover{z-index:2;color:#fff;cursor:default;background-color:#337ab7;border-color:#337ab7}footer{display:flex;background:url(/images/footer.jpg) no-repeat center;background-size:100% 100%;padding:0 15px}#call_icon{position:fixed;right:10px;bottom:80px;z-index:9999999}footer p{font-family:Roboto,sans-serif;color:#fff;padding:5px;margin:0;display:flex;width:100%}.thongtin{font-size:24px}.col-lg-12{text-align:center;padding:0 15px;padding-bottom:5px}.text-theme{color:#ccc;font-family:Roboto,sans-serif;font-size:12px}.cty{font-size:14px;font-weight:700}.vanphong,.dienthoai,.mail{font-size:14px}a{color:#337ab7;text-decoration:none}.fa{display:inline-block;font:normal normal normal 14px/1 FontAwesome;font-size:inherit;text-rendering:auto;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;padding-right:5px}.fa-company:before{content:"\f275"}.fa-adress:before{content:"\f279"}.fa-phone:before{content:"\f098"}.fa-mail:before{content:"\f199"}.fa-sm:before{content:"\f118"}.fa-monney:before{content:"\f155"}.fa-secur:before{content:"\f023"}@media only screen and (max-width: 375px){.thumbnail{padding:4px}}
   </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="reg">
                    <div class="mxh">
                        <span class="hotline">
                            Hotline: 0972.022.116 -
                        </span>
                        <a href="skype:live:binhminhmta123?chat"> <span class="sky">banthe247.com</span></a>
                    </div>
                </div>
                <div class="menu">
                    <a href="/" class="navbar-brand" rel="nofollow" title="Website Mua thẻ điện thoại và nạp tiền điện thoại">
                        <amp-img layout="intrinsic" width="170" height="50"  src="/images/logo.png" alt="logo"></amp-img>
                    </a>
                    <button id="showMenu" on="tap:menuBar.open">
                        <div class="icon-bar"></div>
                        <div class="icon-bar"></div>
                        <div class="icon-bar"></div>
                    </button>
                    <amp-sidebar style="width: 300px" id="menuBar" class="sample-sidebar" layout="nodisplay" side="right">
                        <button class="menu-nav" on="tap:menuBar.close">X</button>
                        <nav>
                            <ul>
                                <li><a rel="nofollow" href="https://banthe247.com/">Trang chủ</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/the-dien-thoai">Mua thẻ điện thoại</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/mua-the-game">Mua thẻ game</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/nap-tien-dien-thoai">Nạp tiền điện thoại</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/thong-bao-mua-tcoin">Nạp tiền vào tài khoản</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/chiet-khau">Chiết khấu</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/the-giay">Thẻ giấy</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/may-in-the-cao">Máy in</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/chuyen-muc-hoi-dap">Hỏi đáp</a></li>
                                <li><a rel="nofollow" on="tap:menuBar2.open">Tin tức</a></li>
                            </ul>
                        </nav>
                    </amp-sidebar>
                    <amp-sidebar style="width: 300px" id="menuBar2" class="sample-sidebar" layout="nodisplay" side="right">
                        <button class="menu-nav" on="tap:menuBar2.close">X</button>
                        <nav >
                            <ul>
                                <li><a rel="nofollow" href="https://banthe247.com/tin-tuc-1.html">Tin tức bán thẻ</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/huong-dan-su-dung-5.html">Hướng dẫn</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/doi-the">Đổi thẻ</a></li>
                                <li><a rel="nofollow" href="https://banthe247.com/game-app-8.html">Game app</a></li>
                            </ul>
                        </nav>
                    </amp-sidebar>
                </div>
            </div>
        </div>
    </header>
    <div class="container1">
        <div class="divcontent1"></div>
        <div class="row1">
            <div class="col-md-12 col-xs-12 main-tintuc-left">
                <h1 class="page_title"><?= $rowinfo['CategoryName'] ?></h1>
                    <div class="list_title">
                    <? 
                    While($rowcate = mysql_fetch_assoc($db_qrcat->result))
                                {
                                    if($rowcate['ShortTitle'] != NULL)
                                {
                                    $urlshort = $rowcate['ShortTitle'];
                                }
                                else
                                {
                                    $urlshort = $rowcate['Title'];
                                }
                                $src=$rowcate['ImageUrl'];
                                if(strpos($rowcate['ImageUrl'],'/upload/') === false)//files
                                {
                                    $src="/pictures/news/".$rowcate['ImageUrl'];
                                }
                    ?>
                    <div class="new_item">
                        <div class="new_item_img col-md-3 col-sm-3">
                        <a href="<?= rewrite_news($rowcate['Id'],$urlshort,$rowcate['categoryname']) ?>" class="thumbnail">
                                    <amp-img layout="intrinsic"  width=900 height=500 alt="<?= $rowcate['Title'] ?>" src="<?= $src ?>" class="media-object lazy wp-post-image" style="display: block;"> </amp-img></a> 
                        
                        </div>
                        <div class="new_title col-md-9 col-sm-9">
                        <h2 class="heading_title"><a title="<?= $rowcate['Title'] ?>" href="<?= rewrite_news($rowcate['Id'],$urlshort,$rowcate['categoryname']) ?>"><?= $rowcate['Title'] ?></a></h2>
                        <div class="box-meta"><i class="far fa-clock"></i> Cập nhật: <?= date("d/m/Y h:i:s A",strtotime($rowcate['PublicDate'])) ?></div>
                        <div class="title">
                        <?= trim(removeHTML($rowcate['Intro'])) ?>  
                        </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <?}?>
                    </div>
                    <div class="pull-right pagination">
                        <div class="col-sm-12" style="text-align:right">
                        <ul class="pagination">
                            <?
                            echo generatePageBar3('',$page,$curentPage,$count,rewriteNews($catid,$rowinfo['CategoryName']),'?','','active','preview','<','next','>','first','Đầu','last','Cuối');
                            ?>
                            <li style="display:none" id="tongSoTrang"><?= $pageccr ?></li>
                        </ul>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-detail">
            <p class="thongtin">Thông tin liên hệ</p>
            <p class="cty"><i class="fa fa-industry"></i>Công ty cổ phần thanh toán Hưng Hà</p>
            <p class="vanphong"><i class="fa fa-map"></i>Văn phòng: Thôn Thanh Miếu, Xã Việt Hưng, Huyện Văn Lâm, Tỉnh Hưng Yên</p>
            <p class="dienthoai"><i class="fa fa fa-phone-square"></i>Điện thoại: 0972.022.116 hoặc 1900633682 ấn phím 2</p>
            <p class="mail"><i class="fa fa-envelope-square"></i>Email: HotroBanthe247.com</p>
            <p style="font-size:24px">Tải ứng dụng</p>
            <div class="btn_app" style="text-align: left;position: relative;margin-bottom:7px;"> <a href="https://play.google.com/store/apps/details?id=com.banthe247" rel="nofollow"><amp-img width="170" height="50" class=" lazyloaded" src="/images/button_app_adr.png" data-src="/images/button_app_adr.png" alt="ứng dụng banthe247"></a> </div>
            <p><i class="fa fa-smile-o"></i>Mua thẻ cào nhanh chóng, tiện lợi</p>
            <p><i class="fa fa-usd"></i>Thanh toán an toàn, tiết kiệm</p>
            <p><i class="fa fa-lock"></i>Bảo mật SSl</p>
            <a rel="nofollow" href="tel:0972022116" id="call_icon">
                <amp-img width="50" height="50" alt="Liên hệ qua số điện thoại" src="/images/icon_phone.png"></amp-img>
            </a>
            <div class="col-lg-12">
                <span class="text-theme copyrightft">
                    Copyright © 2015 
                    <a rel="nofollow" href="https://banthe247.com">Banthe247.com</a> 
                </span> 
            </div>
        </div>
    </footer>
</body>
<amp-analytics type="googleanalytics">
    <script type="application/json">
    {
    "vars": {
        "account": "UA-131300376-1"
    },
    "triggers": {
        "trackPageview": {
        "on": "visible",
        "request": "pageview"
        }
    }
    }
    </script>
</amp-analytics>
</html>